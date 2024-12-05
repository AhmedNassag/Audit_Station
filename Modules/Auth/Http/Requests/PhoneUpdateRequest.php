<?php

namespace Modules\Auth\Http\Requests;

use App\Helpers\RequestHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class PhoneUpdateRequest extends FormRequest
{
    use HttpResponse;

    public function prepareForValidation(): void
    {
        RequestHelper::formatPhoneNumber($this);
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'numeric'],
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
