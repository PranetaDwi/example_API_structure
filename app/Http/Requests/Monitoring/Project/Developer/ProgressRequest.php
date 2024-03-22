<?php

namespace App\Http\Requests\Monitoring\Project\Developer;

use Illuminate\Foundation\Http\FormRequest;

class ProgressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'brief_description' => 'required|max:500',
            'detail_description' => 'required',
            'percentage' => 'required|numeric|between:0,100',
            'photo_file' => 'nullable|file|array|image|mimes:jpeg,png|max:2048'
        ];
    }

}
