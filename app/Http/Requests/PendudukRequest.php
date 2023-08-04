<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PendudukRequest extends FormRequest
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
            "nik"                   => 'required|string|max:255',
            "no_akta_lahir"         => 'required|string|max:255',
            "nama_lengkap_ayah"     => 'required|string|max:255',
            "nama_lengkap_ibu"      => 'required|string|max:255',
            "kk"                    => 'required|string|max:255',
            "nama_lengkap"          => 'required|string|max:255',
            "jenis_kelamin"         => 'required|string|min:1|max:2',
            "tempat_lahir"          => 'required|string|max:255',
            "tanggal_lahir"         => 'required|date',
            "agama"                 => 'required|string|max:255',
            "golongan_darah"        => 'required|string|max:255',
            "pendidikan"            => 'required|string|max:255',
            "status_dalam_keluarga" => 'required|string|max:255',
            "status_kawin"          => 'required|string|max:255',
            "aktaKawin"             => 'required|string|max:255',
            "pekerjaan"             => 'required|string|max:255',
        ];
    }
}
