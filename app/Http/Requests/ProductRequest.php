<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return[
            'product_name' => 'required|max:255|regex:/^[a-zA-Zぁ-んァ-ヶーー-龠]+$/',
            'price' => 'required|regex:/^[0-9]+$/',
            'description' => 'required',
            'stock' => 'required|regex:/^[0-9]+$/',
            'img_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return[
            'product_name.required' => '商品名は必須です。',
            'product_name.max' => '商品名は255文字以内で入力してください。',
            'product_name.regex' => '商品名はひらがな、カタカナ、漢字、英字のみで入力してください。',
            'price' => '金額は必須です。',
            'price.regex' => '金額は半角数字で入力してください。',
            'description' => '説明は必須です。',
            'stock' => '在庫数は必須です。',
            'stock.regex' => '在庫数は半角数字で入力してください。',
            'img_path.required' => '画像ファイルを選択してください。',
            'img_path.image' => '画像ファイルをアップロードしてください。',
            'img_path.mimes' => '画像はjpeg,png,jpg,gif形式でアップロードしてください。',
            'img_path.max' => '画像サイズは2MB以下にしてください。',
        ];
    }
}