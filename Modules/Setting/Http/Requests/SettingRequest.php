<?php

namespace Modules\Setting\Http\Requests;

use App\Helpers\ValidationRuleHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class SettingRequest extends FormRequest
{
    use HttpResponse;

    public function rules(): array
    {
        return [
            'head_quarters' => ValidationRuleHelper::arrayRules([
                'required' => 'sometimes',
            ]),
            'head_quarters.*' => ValidationRuleHelper::stringRules([
                'required' => 'sometimes',
            ]),
            'our_branches' => ValidationRuleHelper::arrayRules([
                'required' => 'sometimes',
            ]),
            'our_branches.*' => ValidationRuleHelper::stringRules([
                'required' => 'sometimes',
            ]),
            'phones' => ValidationRuleHelper::arrayRules([
                'required' => 'sometimes',
            ]),
            'phones.*' => ValidationRuleHelper::phoneRules([
                'required' => 'sometimes',
            ]),
            'address' => ValidationRuleHelper::stringRules([
                'required' => 'sometimes',
            ]),
            'email' => ValidationRuleHelper::emailRules([
                'required' => 'sometimes',
            ]),
            'facebook' => ValidationRuleHelper::urlRules(false),
            'linkedin' => ValidationRuleHelper::urlRules(false),
            'youtube' => ValidationRuleHelper::urlRules(false),
            'tiktok' => ValidationRuleHelper::urlRules(false),
            'snapchat' => ValidationRuleHelper::urlRules(false),
            'app_store' => ValidationRuleHelper::urlRules(false),
            'google_play' => ValidationRuleHelper::urlRules(false),
            'latitude' => ValidationRuleHelper::latitudeRules([
                'required' => 'sometimes',
            ]),
            'longitude' => ValidationRuleHelper::longitudeRules([
                'required' => 'sometimes',
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
