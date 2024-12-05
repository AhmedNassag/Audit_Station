<?php

namespace Modules\Category\Http\Requests;

use App\Helpers\ValidationRuleHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ParentCategoryRequest extends FormRequest
{
    use HttpResponse;

    public function rules(): array
    {
        $inUpdate = ! preg_match('/.*parent_categories$/', $this->url());
        info($inUpdate);

        return [
            'name' => ValidationRuleHelper::stringRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            //            'image' => ValidationRuleHelper::storeOrUpdateImageRules($inUpdate),
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
