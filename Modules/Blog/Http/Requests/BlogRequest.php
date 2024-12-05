<?php

namespace Modules\Blog\Http\Requests;

use App\Helpers\ValidationRuleHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BlogRequest extends FormRequest
{
    use HttpResponse;

    public function rules(): array
    {
        $inUpdate = ! preg_match('/.*blogs$/', $this->url());

        return [
            'title' => ValidationRuleHelper::stringRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'minutes' => ValidationRuleHelper::tinyInteger([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'description' => ValidationRuleHelper::longTextRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'tags' => ValidationRuleHelper::arrayRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'tags.*' => ValidationRuleHelper::stringRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'image' => ValidationRuleHelper::storeOrUpdateImageRules($inUpdate),
            'category_id' => ValidationRuleHelper::foreignKeyRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'blog_author_id' => ValidationRuleHelper::foreignKeyRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
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
