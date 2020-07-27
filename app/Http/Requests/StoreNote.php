<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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
         // ログインしているユーザーIDを取得
        $user_id = Auth::id();
        return [
            'record' => [
                'required',
                'unique:notes',
                //Rule::unique('notes')->where('user_id',$user_id)
                Rule::unique('notes', 'user_id')
                    ->ignore($user_id, 'user_id'),

            ],
            'wake_uptime' => 'required',
            'bedtime' => 'required',
            'body' => 'nullable|string',
        ];
    }
}
