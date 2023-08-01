<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeluargaRequest extends FormRequest
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
            "kk"                   => 'required|integer',
            "nama_kepala_keluarga" => 'required|string|max:255',
            "alamat"               => 'required|string|max:255',
            "dusun"                => 'required|string|max:255',
            "desa"                 => 'required|string|max:255',
            "kecamatan"            => 'required|string|max:255',
        ];
    }
}
