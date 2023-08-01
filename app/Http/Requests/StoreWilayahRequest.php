<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWilayahRequest extends FormRequest
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
            'nama'   => 'required|string|max:255',
            'alamat' => 'required|string',
            'lat'    => 'required|string',
            'long'   => 'required|string',
            'info'   => 'required|string',
            'img'    => 'required|image:jpg,png,jpeg'
        ];
    }
}
