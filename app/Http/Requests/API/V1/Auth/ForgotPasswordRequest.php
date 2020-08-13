<?php

namespace App\Http\Requests\API\V1\Auth;

use Config;
use Dingo\Api\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    public function rules()
    {
        return Config::get('api-validations.forgot_password.validation_rules');
    }

    public function authorize()
    {
        return true;
    }
}
