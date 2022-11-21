<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluationStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'value' => 'required|integer|min:1|max:10',
            'user-lesson-id' => 'required|uuid',
            'date' => 'required|date',
        ];
    }
}
