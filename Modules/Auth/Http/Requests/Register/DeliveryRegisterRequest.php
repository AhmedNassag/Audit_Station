<?php

namespace Modules\Auth\Http\Requests\Register;

use App\Helpers\RequestHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Modules\DeliveryMan\Http\Requests\DeliveryRequest;

class DeliveryRegisterRequest extends FormRequest
{
    use HttpResponse;

    public function prepareForValidation()
    {
        RequestHelper::formatPhoneNumber($this);
        RequestHelper::formatPhoneNumber($this, 'whatsapp');
    }

    public function rules(): array
    {
        return DeliveryRequest::baseRules($this->delivery_type);
    }

    /**
     * @throws ValidationException
     */
    public function failedValidation(Validator $validator): void
    {
        $this->throwValidationException($validator);
    }
}
