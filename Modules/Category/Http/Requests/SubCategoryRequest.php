<?php

namespace Modules\Category\Http\Requests;

use App\Helpers\ValidationRuleHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
{
    use HttpResponse;

    public function rules(): array
    {
        $inUpdate = ! preg_match('/.*sub_categories$/', $this->url());

        return [
            'name' => ValidationRuleHelper::stringRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            //            'image' => ValidationRuleHelper::storeOrUpdateImageRules($inUpdate),
            'parent_id' => ValidationRuleHelper::foreignKeyRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        $this->throwValidationException($validator);
    }
}
