<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BendaharaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nip' => 'required|unique:bendahara|min:6|max:6',
            'nama'=> 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'jabatan' => 'required'
        ];
    }
}
