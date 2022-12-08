<?php

namespace App\Http\Requests;

use App\Constants\RequestConstants;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            RequestConstants::USER_REQUEST_USERNAME => 'required|unique:users|string|max:50',
            RequestConstants::USER_REQUEST_NAME => 'required|string|max:50',
            RequestConstants::USER_REQUEST_LAST_NAME => 'required|string|max:50',
            RequestConstants::USER_REQUEST_EMAIL => 'required|unique:users|string|email',
            RequestConstants::USER_REQUEST_PASSWORD => 'required'
        ];
    }
}
