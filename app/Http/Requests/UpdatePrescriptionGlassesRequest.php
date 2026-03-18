<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrescriptionGlassesRequest extends FormRequest
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
            'left_sphere' => 'required|numeric',
            'right_sphere' => 'required|numeric',
            'left_cylinder' => 'required|numeric',
            'right_cylinder' => 'required|numeric',
            'left_axis' => 'required|integer',
            'right_axis' => 'required|integer',
            'pd' => 'required|integer',
        ];
    }
}
