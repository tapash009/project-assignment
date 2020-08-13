<?php

namespace App\Http\Requests\API\V1\Auth;

use Config;
use Dingo\Api\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return Config::get('api-validations.login.validation_rules');
    }

    public function authorize()
    {
        return true;
    }
}
