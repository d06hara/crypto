<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|max:20|unique:users,name',
            'email' => 'required|email|unique:users,email',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '入力必須です',
            'name.max:20' => '２０文字以内で入力してください',
            'name.unique:users,name' => '入力されたユーザー名は既に使用されています',
            'email.required' => '入力必須です',
            'email.email' => 'メールアドレスの形式ではありません',
            'email.unique:users,email' => '入力されたemailは既に使用されています'
        ];
    }
}
