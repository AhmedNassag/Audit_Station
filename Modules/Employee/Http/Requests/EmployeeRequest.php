<?php

namespace Modules\Employee\Http\Requests;

use App\Helpers\RequestHelper;
use App\Helpers\ValidationRuleHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class EmployeeRequest extends FormRequest
{
    use HttpResponse;

    public function prepareForValidation()
    {
        RequestHelper::formatPhoneNumber($this);
    }

    public function rules(): array
    {
        $inUpdate = ! preg_match('/.*employees$/', $this->url());

        return [
            'name' => ValidationRuleHelper::stringRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'email' => ValidationRuleHelper::emailRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'phone' => ValidationRuleHelper::phoneRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'password' => ValidationRuleHelper::defaultPasswordRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'role_id' => ValidationRuleHelper::foreignKeyRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'avatar' => ValidationRuleHelper::storeOrUpdateImageRules($inUpdate),
        ];
    }

    /**
     * @throws ValidationException
     */
    public function failedValidation(Validator $validator): void
    {
        $this->throwValidationException($validator);
    }
}
