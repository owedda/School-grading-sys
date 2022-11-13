<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLessonStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user-id' => 'required|uuid',
            'lesson-id' => 'required|uuid',
        ];
    }
}
