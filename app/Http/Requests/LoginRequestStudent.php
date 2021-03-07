<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequestStudent extends FormRequest
{
    public function rules()
    {
        return [
            'code' => 'required|exists:students',
            'password' => 'required'
        ];
    }
}
