<?php

namespace Modules\Comment\Http\Requests;

use App\Helpers\ValidationRuleHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Modules\Comment\Enums\CommentTypeEnum;

class CommentRequest extends FormRequest
{
    use HttpResponse;

    public function prepareForValidation(): void
    {
        $this->merge([
            'type' => CommentTypeEnum::BLOG,
        ]);
    }

    public function rules(): array
    {
        $inUpdate = $this->method() == 'PUT';

        return [
            ...CommentFilterRequest::baseRules(),
            'id' => ValidationRuleHelper::foreignKeyRules(),
            'content' => ValidationRuleHelper::longTextRules(),
            'parent_id' => ValidationRuleHelper::foreignKeyRules([
                'required' => $inUpdate ? 'exclude' : 'nullable',
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
