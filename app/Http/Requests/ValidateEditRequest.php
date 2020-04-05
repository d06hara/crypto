<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ValidateEditRequest extends FormRequest
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
            'name' => [
                'required', Rule::unique('users')->ignore(Auth::id()),
                'max:20',
            ],
            'email' => [
                'required', Rule::unique('users')->ignore(Auth::id()),
                'email',
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '入力必須です',
            'name.max' => '２０文字以内で入力してください',
            'name.unique' => '入力されたユーザー名は既に使用されています',
            'email.required' => '入力必須です',
            'email.email' => 'メールアドレスの形式ではありません',
            'email.unique' => '入力されたemailは既に使用されています'
        ];
    }
}
