<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasienRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        // cek apakah status bpjs 
        if ($this->status == 'bpjs') {
            $no_bpjs = 'required|numeric|unique:pasiens|min:12|max:20';
        } else {
            $no_bpjs = '';
        }

        return [
            'no_rm' => 'required|numeric',
            'nama' => 'required|:min:2',
            'nama_kk' => 'required|min:2',
            'jenis_kelamin' => 'required',
            'hubungan' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required|min:5',
            'status' => 'required',
            'no_bpjs' => $no_bpjs,
            'riwayat_alergi' => ''
        ];
    }
}
