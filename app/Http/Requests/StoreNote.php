<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Note;

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
        //$record = Note::where('user_id',$user_id)->where('record', $this->record)->exists();
        return [
            'record' => [
                'required',
                Rule::unique('notes')->where(function ($query) {
                    $user_id = Auth::id();
                    return $query->where('user_id',$user_id)->where('record', $this->record);
                })
            ],
            'wake_uptime' => 'required',
            'bedtime' => 'required',
            'body' => 'nullable|string',
        ];
    }
}
