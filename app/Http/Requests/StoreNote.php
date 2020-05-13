<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNote extends FormRequest
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
            'record' => 'required',
            'wake_uptime' => 'required',
            'bedtime' => 'required',
            //'am_image' => 'required',
            //'pm_image' => 'required',
            //'nigiht_image' => 'required',
            'body' => 'string',
        ];
    }
}
