<?php

namespace Modules\OurTeam\Http\Requests;

use App\Helpers\ValidationRuleHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class OurTeamRequest extends FormRequest
{
    use HttpResponse;

    public function rules()
    {
        $inUpdate = ! preg_match('/.*our_team$/', $this->url());

        return [
            'name' => ValidationRuleHelper::stringRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'image' => ValidationRuleHelper::storeOrUpdateImageRules($inUpdate),
            'section_id' => ValidationRuleHelper::foreignKeyRules([
                'required' => $inUpdate ? 'sometimes' : 'required',
            ]),
            'facebook' => ValidationRuleHelper::urlRules(false),
            'instagram' => ValidationRuleHelper::urlRules(false),
            'twitter' => ValidationRuleHelper::urlRules(false),
            'telegram' => ValidationRuleHelper::urlRules(false),
            'whatsapp' => ValidationRuleHelper::urlRules(false),
            'snapchat' => ValidationRuleHelper::urlRules(false),
            'tiktok' => ValidationRuleHelper::urlRules(false),
            'github' => ValidationRuleHelper::urlRules(false),
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        $this->throwValidationException($validator);
    }
}
