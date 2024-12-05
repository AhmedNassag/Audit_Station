<?php

namespace Modules\Service\Http\Requests;

use App\Helpers\ValidationRuleHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ServiceRequest extends FormRequest
{
    use HttpResponse;

    public function rules(): array
    {
        $inUpdate = ! preg_match('/.*services$/', $this->url());

        return [
            'title' => ValidationRuleHelper::stringRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'description' => ValidationRuleHelper::longTextRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'image' => ValidationRuleHelper::storeOrUpdateImageRules($inUpdate),
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
