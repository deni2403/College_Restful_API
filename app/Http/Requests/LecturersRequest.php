<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LecturersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'lecturers_id' => ['required', 'string', 'max:9'],
            'field' => ['required', 'string', 'max:100'],
            'gender' => ['required', 'in:Male,Female'],
        ];
    }
}
