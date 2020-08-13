<?php

namespace App\Http\Requests\Backend\Auth\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateUserRequest.
 */
class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'dob' => ['required'],
            'country_id' => ['required', 'regex:/^[0-9]+$/'],
            'state_id' => ['required', 'regex:/^[0-9]+$/'],
            'city' => ['required', 'string'],
            'address' => ['required', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function messages(){
        return [
            'country_id.regex' => 'The country id should be numeric.',
            'state_id.regex' => 'The state id should be numeric.',
        ];
    }
}
