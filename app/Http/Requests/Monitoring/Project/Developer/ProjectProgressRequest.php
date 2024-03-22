<?php

namespace App\Http\Requests\Monitoring\Project\Developer;

use Illuminate\Foundation\Http\FormRequest;

class ProjectProgressRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'         => 'required|max:100',
            'buyer_name'    => 'required|max:100',
            'buyer_phone'   => 'required|max:15',
            'address'       => 'required|max:300',
            'province'      => 'required',
            'district'      => 'required',
            'city'          => 'required',
            'status'        => 'required',
            'start_date'    => 'required|date',
            'start_date'    => 'nullable|date',
            'price'         => 'required|numeric',
        ];
    }
}
