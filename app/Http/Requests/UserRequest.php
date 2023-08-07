<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return [
            "id_jabatan"           => 'required|integer',
            "username"             => 'required|string|max:255',
            // "password"             => 'nullable|required_with:password_confirmation|string|confirmed',
            // "current_password"     => 'required',
        ];
    }
}
