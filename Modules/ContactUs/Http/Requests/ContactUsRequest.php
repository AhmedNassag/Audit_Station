<?php

namespace Modules\ContactUs\Http\Requests;

use App\Helpers\ValidationRuleHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ContactUsRequest extends FormRequest
{
    use HttpResponse;

    public function rules(): array
    {
        return [
            'name' => ValidationRuleHelper::stringRules(),
            'email' => ValidationRuleHelper::emailRules(),
            'subject' => ValidationRuleHelper::stringRules(),
            'message' => ValidationRuleHelper::longTextRules(),
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
