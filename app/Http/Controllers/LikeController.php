<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likeProduct(Product $product)
    {
        $user = Auth::user();

        if (!$product->likedBy($user)) {
            Like::create([
                'product_id' => $product->id,
                'user_id' => $user->id,
            ]);
        }
    }

    public function unlikeProduct(Product $product)
    {
        $user = Auth::user();

        if ($product->likedBy($user)) {
            Like::where('product_id', $product->id)
                ->where('user_id', $user->id)
                ->delete();
        }
    }
}