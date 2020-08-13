<?php

namespace App\Http\Requests\API\V1\Auth;

use Config;
use Dingo\Api\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    public function rules()
    {
        return Config::get('api-validations.sign_up.validation_rules');
    }

    public function authorize()
    {
        return true;
    }
}
