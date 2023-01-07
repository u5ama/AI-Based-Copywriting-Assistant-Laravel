<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegisterRequest extends FormRequest
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
            'username' => 'required|max:50',
            'email' => 'required|max:50|unique:user|email',
            'password' => 'required_with:confirm_password|same:confirm_password|min:8',
            'confirm_password' =>'required',
            'checkbox'=>'required'
        ];
    }
}
