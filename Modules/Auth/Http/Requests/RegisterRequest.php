<?php

namespace Modules\Auth\Http\Requests;

use App\Helpers\RequestHelper;
use App\Helpers\ValidationRuleHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Modules\Auth\Enums\UserTypeEnum;

class RegisterRequest extends FormRequest
{
    use HttpResponse;

    public function prepareForValidation(): void
    {
        RequestHelper::formatPhoneNumber($this);
    }

    public function rules(): array
    {
        return [
            'type' => ValidationRuleHelper::enumRules([
                UserTypeEnum::PARENT,
                UserTypeEnum::USER,
            ]),
            'name' => ValidationRuleHelper::stringRules(),
            'phone' => ValidationRuleHelper::phoneRules(),
            'email' => ValidationRuleHelper::emailRules([
                'required' => 'sometimes',
            ]),
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
