<?php

namespace Modules\Auth\Http\Requests\Register;

use App\Helpers\RequestHelper;
use App\Helpers\ValidationRuleHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Modules\Address\Http\Requests\AddressRequest;
use Modules\Vendor\Http\Requests\VendorRequest;

class VendorRegisterRequest extends FormRequest
{
    use HttpResponse;

    public function prepareForValidation()
    {
        RequestHelper::formatPhoneNumber($this);
        RequestHelper::formatPhoneNumber($this, 'whatsapp');
        RequestHelper::formatPhoneNumber($this, 'vendor_phone');
    }

    public function rules(): array
    {
        return VendorRequest::baseRules();
        //        return [
        //            ...BaseRegisterRequest::baseRules(),
        //            ...AddressRequest::baseRules(),
        //            'whatsapp' => ValidationRuleHelper::phoneRules(),
        //            'vendor_name' => ValidationRuleHelper::stringRules(),
        //            'vendor_logo' => ValidationRuleHelper::storeOrUpdateImageRules(),
        //            'commercial_register' => ValidationRuleHelper::storeOrUpdateImageRules(true),
        //            'tax_card' => ValidationRuleHelper::storeOrUpdateImageRules(true),
        //            'vendor_phone' => ValidationRuleHelper::phoneRules(),
        //            'vendor_email' => ValidationRuleHelper::emailRules(),
        //            'vendor_description' => ValidationRuleHelper::longTextRules(),
        //            'categories' => ValidationRuleHelper::arrayRules(),
        //            'categories.*' => ValidationRuleHelper::foreignKeyRules(),
        //        ];
    }

    /**
     * @throws ValidationException
     */
    public function failedValidation(Validator $validator): void
    {
        $this->throwValidationException($validator);
    }
}
