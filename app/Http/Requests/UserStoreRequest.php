<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|unique:users|string|max:50',
            'name' => 'required|string|max:50',
            'last-name' => 'required|string|max:50',
            'email' => 'required|unique:users|string|email',
            'password' => 'required'
        ];
    }
}
