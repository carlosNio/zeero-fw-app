<?php

namespace App\Controllers\Requests;

use Zeero\Core\Validator\Form;

class LoginRequest extends Form
{
    protected $redirectTo = "/login";

    public function rules()
    {
        return [
            "name" => "required|pattern:alfa_str",
            "password" => "required|min:6"
        ];
    }

    public function messages()
    {
        return [
            "required" => "please fill all fields",
            "name.pattern" => "invalid name",
            "password.min" => "the password must contains at least {min} chars"
        ];
    }

}