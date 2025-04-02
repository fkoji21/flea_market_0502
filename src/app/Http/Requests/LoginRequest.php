<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
            'categories' => 'required|array|min:1',
            'categories.*' => 'integer|exists:categories,id',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください',
            'categories.required' => 'カテゴリーを選択してください。',
            'categories.array' => 'カテゴリーの形式が正しくありません。',
            'categories.min' => '少なくとも1つのカテゴリーを選択してください。',
            'categories.*.integer' => 'カテゴリーIDは整数である必要があります。',
            'categories.*.exists' => '選択されたカテゴリーが無効です。',

        ];
    }
}
