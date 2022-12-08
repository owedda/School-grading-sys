<?php

namespace App\Http\Requests;

use App\Constants\RequestConstants;
use Illuminate\Foundation\Http\FormRequest;

class EvaluationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            RequestConstants::EVALUATION_REQUEST_VALUE => 'required|integer|min:1|max:10',
            RequestConstants::EVALUATION_REQUEST_USER_LESSON_ID => 'required|uuid',
            RequestConstants::EVALUATION_REQUEST_DATE => 'required|date',
        ];
    }
}
