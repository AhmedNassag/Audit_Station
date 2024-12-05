<?php

namespace Modules\Employee\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HttpResponse;
use Modules\Auth\Enums\UserTypeEnum;
use Modules\Auth\Transformers\UserResource;
use Modules\Employee\Http\Requests\EmployeeRequest;
use Modules\Employee\Services\EmployeeService;

class EmployeeController extends Controller
{
    use HttpResponse;

    public function __construct(private readonly EmployeeService $employeeService) {}

    public function index()
    {
        $employees = $this->employeeService->index();

        return $this->paginatedResponse($employees, UserResource::class);
    }

    public function show($id)
    {
        $employee = $this->employeeService->show($id);

        return $this->resourceResponse(UserResource::make($employee));
    }

    public function store(EmployeeRequest $request)
    {
        $this->employeeService->store($request->validated());

        return $this->createdResponse(message: translate_success_message('employee', 'created'));
    }

    public function update(EmployeeRequest $request, $id)
    {
        $this->employeeService->update($request->validated(), $id);

        return $this->okResponse(message: translate_success_message('employee', 'updated'));
    }

    public function destroy($id)
    {
        User::where('type', UserTypeEnum::ADMIN_EMPLOYEE)->findOrFail($id)->delete();

        return $this->okResponse(message: translate_success_message('employee', 'deleted'));
    }
}
