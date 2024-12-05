<?php

namespace Modules\Comment\Http\Requests;

use App\Helpers\ValidationRuleHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Modules\Comment\Enums\CommentTypeEnum;

class CommentFilterRequest extends FormRequest
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
        return [
            ...self::baseRules(),
            'user_id' => ValidationRuleHelper::foreignKeyRules([
                'required' => 'nullable',
            ]),
            'commentable_id' => ValidationRuleHelper::foreignKeyRules([
                'required' => 'nullable',
            ]),
            'parent_id' => ValidationRuleHelper::foreignKeyRules([
                'required' => 'nullable',
            ]),
        ];
    }

    public static function baseRules(): array
    {
        return [
            'type' => ValidationRuleHelper::enumRules(CommentTypeEnum::toArray()),
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
