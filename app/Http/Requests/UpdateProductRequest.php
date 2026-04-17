<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return[
            'product_name' => 'required|max:255',
            'price' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return[
            'product_name.required' => '商品名は必須です。',
            'product_name.max' => '商品名は255文字以内で入力してください。',
            'price' => '金額は必須です。',
            'description' => '説明は必須です。',
            'stock' => '在庫数は必須です。',
            'img_path.image' => '画像ファイルをアップロードしてください。',
            'img_path.mimes' => '画像はjpeg,png,jpg,gif形式でアップロードしてください。',
            'img_path.max' => '画像サイズは2MB以下にしてください。',
        ];
    }
}