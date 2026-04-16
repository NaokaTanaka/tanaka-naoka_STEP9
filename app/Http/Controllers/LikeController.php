<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likeProduct(Request $request, Product $product)
    {
        $user = Auth::user();

        if (!$product->likedBy($user)) {
            Like::create([
                'product_id' => $product->id,
                'user_id' => $user->id,
            ]);
        }

        return response()->json([
            'likes_count' => $product->likes()->count(),
        ]);
    }

    public function unlikeProduct(Request $request, Product $product)
    {
        $user = Auth::user();

        if ($product->likedBy($user)) {
            Like::where('product_id', $product->id)
                ->where('user_id', $user->id)
                ->delete();
        }

        return response()->json([
            'likes_count' => $product->likes()->count(),
        ]);
    }
}
