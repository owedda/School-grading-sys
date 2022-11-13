<?php

namespace App\Http\Requests;

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
            'user-id' => 'uuid',
            'lesson-id' => 'uuid',
        ];
    }
}
