<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreColum extends FormRequest
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
        return [
            'situation' =>  'required|max:140',
            'feeling' =>  'required|max:140',
            'think' =>  'required|max:140',
            'another_think' =>  'max:140',
            'another_feeling' => 'max:140',
            'another_situation' => 'max:140' 
        ];
    }
}
