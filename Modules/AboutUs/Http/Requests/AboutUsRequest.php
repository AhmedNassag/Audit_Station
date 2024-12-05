<?php

namespace Modules\AboutUs\Http\Requests;

use App\Helpers\ValidationRuleHelper;
use Illuminate\Foundation\Http\FormRequest;

class AboutUsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => ValidationRuleHelper::stringRules([
                'required' => 'sometimes',
            ]),
            'description' => ValidationRuleHelper::longTextRules([
                'required' => 'sometimes',
            ]),
            'image' => ValidationRuleHelper::storeOrUpdateImageRules(true),
            'youtube_link' => ValidationRuleHelper::urlRules(false),
            'items' => ValidationRuleHelper::arrayRules([
                'required' => 'sometimes',
                'max' => 'max:3',
            ]),
            'items.*' => ValidationRuleHelper::stringRules([
                'required' => 'sometimes',
            ]),
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
