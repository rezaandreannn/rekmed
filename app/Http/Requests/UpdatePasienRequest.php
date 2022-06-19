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
            $no_bpjs = 'required';
        } else {
            $no_bpjs = '';
        }

        return [
            'no_rm' => 'required',
            'nama' => 'required',
            'nama_kk' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => '',
            'alamat' => 'required',
            'status' => 'required',
            'no_bpjs' => $no_bpjs
        ];
    }
}
