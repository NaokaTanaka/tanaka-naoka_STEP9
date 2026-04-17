<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductsController extends Controller
{
    public function showProducts()
    {
        $user_id = Auth::id();
        $products = Product::where('user_id', '!=', $user_id)->get();
        return view('products', compact('products'));
    }

    // 商品検索
    public function search(Request $request)
    {
        $user_id = Auth::id();
        $query = Product::query()->where('user_id', '!=', $user_id);;
        // 商品名検索
        if ($request->filled('product_name')) {
            $query->where('product_name', 'like', '%' . $request->product_name . '%');
        }

        // 最低金額
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

         // 最高金額
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        $products = $query->get();
        return view('products', compact('products'));
    }

    // マイページ画面表示
    public function mypage()
    {
        // ログインユーザIDを取得
        $user_id = Auth::id();
        $products = Product::where('user_id', $user_id)->get();
        $sales = Sale::with('product')->where('user_id', $user_id)->get();
        return view('mypage', compact('products', 'sales'));
    }

    // 商品登録画面表示
    public function registration()
    {
        return view('registration');
    }

    // 詳細画面表示
    public function show($id)
    {
        $products = Product::with('company')->where('id', $id)->get();
        return view('detail_products', compact('products'));
    }

    public function showMyItem($id)
    {
        $products = Product::with('company')->where('id', $id)->get();
        return view('detail_item', compact('products'));
    }

    // 投稿データを保存
    public function products(ProductRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();
        $data['company_id'] = Auth::user()->company_id;

        // 画像処理
        if ($request->hasFile('img_path')) {
            $data['img_path'] = $request->file('img_path')->store('images', 'public');
        }

        // リダイレクト
        Product::create($data);
        return redirect()->route('mypage');
    }

    // 更新画面の表示
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('item_update', compact('product'));
    }

    // 更新処理
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        // 画像がアップロードされた場合
        if($request->hasFile('img_path')) {
            // 既存の画像を削除
            if ($product->img_path) {
                Storage::delete('public/' . $product->img_path);
            }

            // 画像を保存
            $path = $request->file('img_path')->store('images', 'public');
            $data = $request->validated();
            $data['img_path'] = $path;

            $product->update($data);
        } else {
            $product->update($request->validated());
        }

        return redirect()->route('detail_item', $id)->with('success', '商品が更新されました');
    }

    // 削除
    public function destroy($id)
    {
        $products = Product::findOrFail($id);
        $products->delete();

        return redirect()->route('mypage')->with('success', '商品が削除されました');
    }
}