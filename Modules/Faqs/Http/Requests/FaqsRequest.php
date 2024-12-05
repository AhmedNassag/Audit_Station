<?php

namespace Modules\Faqs\Http\Requests;

use App\Helpers\ValidationRuleHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class FaqsRequest extends FormRequest
{
    use HttpResponse;

    public function rules(): array
    {
        $inUpdate = $this->method() == 'PUT';

        return [
            'question' => ValidationRuleHelper::stringRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'answer' => ValidationRuleHelper::longTextRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'category_id' => ValidationRuleHelper::foreignKeyRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'is_important' => ValidationRuleHelper::booleanRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $this->throwValidationException($validator);
    }
}
