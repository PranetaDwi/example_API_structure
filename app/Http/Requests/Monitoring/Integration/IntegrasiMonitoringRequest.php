<?php

namespace App\Http\Requests\Monitoring\Integration;

use Illuminate\Foundation\Http\FormRequest;

class IntegrasiMonitoringRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if (! $this->filled('role')) {
            $this->merge(['role' => 'user']);
        }

        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'password_confirmation' => 'required|same:password',
            'first_name' => 'required|string|regex:/^[a-zA-Z]+$/',
            'last_name' => 'nullable|string|regex:/^[a-zA-Z]+$/',
            'phone' => 'required',
            'city' => 'required',
            'province' => 'required',
            'role' => 'required',
            'status' => 'required',
            'picture_profile_file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => [
                'required_if:role,agent,developer',
                'nullable',
            ],
            'unit_code' => 'required|exists:units,unit_code'
        ];
    }
}
