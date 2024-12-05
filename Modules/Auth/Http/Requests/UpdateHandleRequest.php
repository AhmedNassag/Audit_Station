<?php

namespace Modules\Auth\Http\Requests;

use App\Helpers\RequestHelper;
use App\Helpers\ValidationRuleHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateHandleRequest extends FormRequest
{
    use HttpResponse;

    public function prepareForValidation()
    {
        RequestHelper::formatPhoneNumber($this);
    }

    public function rules(): array
    {
        return [
            'phone' => ValidationRuleHelper::phoneRules(),
            'dial_code_length' => ValidationRuleHelper::dialCodeRules(),
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
