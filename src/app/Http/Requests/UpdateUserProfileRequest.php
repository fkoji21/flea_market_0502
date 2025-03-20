<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'postal_code' => 'required|string|regex:/^\d{3}-?\d{4}$/',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'ユーザー名は必須です。',
            'postal_code.required' => '郵便番号は必須です。',
            'postal_code.regex' => '郵便番号はハイフンあり or なしの7桁で入力してください。',
            'address_line1.required' => '住所は必須です。',
            'profile_image.image' => '画像ファイルをアップロードしてください。',
            'profile_image.max' => '画像サイズは2MB以内にしてください。',
        ];
    }
}
