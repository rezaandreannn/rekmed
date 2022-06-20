<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePasienRequest extends FormRequest
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
            $no_bpjs = 'required';
        } else {
            $no_bpjs = '';
        }

        return [
            'no_rm' => 'required',
            'nama' => 'required',
            'nama_kk' => 'required',
            'jenis_kelamin' => 'required',
            'hubungan' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'status' => 'required',
            'no_bpjs' => $no_bpjs,
            'riwayat_alergi' => ''

        ];
    }
}
