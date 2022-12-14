<?php

namespace App\Http\Requests;

use App\Constants\RequestConstants;
use Illuminate\Foundation\Http\FormRequest;

class DateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            RequestConstants::DATE_REQUEST_DATE => 'required|date'
        ];
    }
}
