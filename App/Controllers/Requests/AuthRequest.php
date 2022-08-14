<?php

namespace App\Controllers\Requests;

use Zeero\Core\Validator\Form;

class AuthRequest extends Form
{
    protected $redirectTo = "/register";

    public function rules()
    {
        return [
            "name" => "required|min:6|pattern:alfa_str|unique:User,name",
            "email" => "required|pattern:email|unique:User,email",
            "password" => "required|min:6",
            "password-confirm" => "required|same:@password",
        ];
    }

    public function messages()
    {
        return [
            "required" => "Please fill all fieds",
            "name.pattern" => "Only alfabetic chars",
            "name.unique" => "Username already registered",
            "password.min" => "Password too short",
            "password-confirm.same" => "Please confirm correctly the password",
            "email.pattern" => "Invalid email address",
            "email.unique" => "Email address already registered",
        ];
    }
}
