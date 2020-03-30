<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ValidChangePassRequest extends FormRequest
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
            'old_password' => 'required',
            'password' => 'required|min:8|different:old_password|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => '入力必須です',
            'password.required' => '入力必須です',
            'password.min:8' => '8文字以上で入力してください',
            'password.different' => '現在のパスワードと違うパスワードにしてください',
            'password.confirmed' => '新しいパスワードと同じパスワードを入力してください'
        ];
    }
}
