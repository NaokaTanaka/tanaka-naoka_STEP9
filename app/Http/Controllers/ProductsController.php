<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
    public function products(Request $request)
    {
        $data = [
            'product_name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'user_id' => Auth::id(),
            'company_id' => Auth::user()->company_id,
        ];

    // 画像処理
    if ($request->hasFile('img_path')) {
        $path = $request->file('img_path')->store('images', 'public');
        $data['img_path'] = $path;
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|max:255',
            'price' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->stock = $request->input('stock');

        // 画像がアップロードされた場合
        if($request->hasFile('img_path')) {
            // 既存の画像を削除
            if ($product->img_path) {
                Storage::delete('public/' . $product->img_path);
            }

            // 画像を保存
            $path = $request->file('img_path')->store('images', 'public');
            $product->img_path = $path;
        }

        $product->save();

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