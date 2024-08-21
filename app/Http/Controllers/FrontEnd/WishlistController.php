<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Auth;
use Illuminate\Validation\ValidationException;

class WishlistController extends Controller
{
    function store(string $productId)
    {
        if (!Auth::check()) {
            throw ValidationException::withMessages(['Please login for add product in wishlist']);
        }

        $productAlreadyExist = Wishlist::where(['user_id' => auth()->user()->id, 'product_id' => $productId])->exists();
        if ($productAlreadyExist) {
            throw ValidationException::withMessages(['Product is already add to wishlist ']);
        }

        $wishlist = new Wishlist();
        $wishlist->user_id = auth()->user()->id;
        $wishlist->product_id = $productId;
        $wishlist->save();

        return response(['status' => 'success', 'message' => 'Product added to wishlist!']);
    }
}
