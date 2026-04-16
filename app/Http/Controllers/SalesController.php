<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function show(Product $product)
    {
        return view('purchase', compact('product'));
    }

    public function purchase(Request $request, Product $product)
    {

        $quantity = $request->input('quantity', 1);

        if ($product->stock < $quantity) {
            return back()->with('error', '在庫が不足しています。');
        }

        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity
            ]);

            $product->decrement('stock', $quantity);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', '購入に失敗しました');
        }

        return redirect()->route('products')->with('success', '購入が完了しました');
    }
}
