<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Products;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class User_WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->renderUserViewPage('user.wishlist.index','wishlist');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $id)
    {
        $user =Auth::user();
        $product = Products::findOrFail($id);
        $response = Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
         if(!$response){
            return response()->json(['success' => false], 500);
         }


        return response()->json(['success' => true]);
    }

    public function destroy(Request $request, int $id)
    {
        $user =Auth::user();
        $wishlistItem = Wishlist::where('user_id', $user->id)
                                ->where('product_id', $id)
                                ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Item not found in wishlist'], 404);
        }
    }

    public function count(Request $request)
    {
        $user = Auth::user();
        $count = Wishlist::where('user_id', $user->id)->count();
        return response()->json(['count' => $count]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }


}
