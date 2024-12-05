<?php

namespace Modules\Section\Http\Requests;

use App\Helpers\ValidationRuleHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
{
    use HttpResponse;

    public function rules()
    {
        return [
            'title' => ValidationRuleHelper::stringRules(),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $this->throwValidationException($validator);
    }
}
