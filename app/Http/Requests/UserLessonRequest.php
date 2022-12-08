<?php

namespace App\Http\Requests;

use App\Constants\RequestConstants;
use Illuminate\Foundation\Http\FormRequest;

class UserLessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            RequestConstants::USER_LESSON_REQUEST_USER_ID => 'required|uuid',
            RequestConstants::USER_LESSON_REQUEST_LESSON_ID => 'required|uuid',
        ];
    }
}
