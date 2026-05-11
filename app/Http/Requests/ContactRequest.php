<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return[
            'name' => 'required|string|max:255|regex:/^[a-zA-Zぁ-んァ-ヶーー-龠]+$/',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => '名前は必須です。',
            'name.max' => '名前は255文字以内で入力してください。',
            'name.regex' => '商品名はひらがな、カタカナ、漢字、英字のみで入力してください。',
            'email.required' => 'Eメールは必須です。',
            'email.max' => 'Eメールは255文字以内で入力してください。',
            'message.required' => '内容は必須です。',
        ];
    }
}