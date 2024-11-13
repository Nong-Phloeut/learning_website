<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
        ->with('course:id,category_id,title,description,price,lessons,rating,image')
                     ->get()
                     ->map(function ($cart) {
                         return $cart->course;
                     });
        // ->with('course')->get();
        return response()->json($cartItems, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart = Cart::store($request);
        return $cart;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $courseId)
    {
        // $cartItem = Cart::where('course_id', Auth::id())->findOrFail($id);
        $cartItem = Cart::where('course_id', $courseId)
                         ->where('user_id', auth()->id())
                         ->first();
        // $favorite->delete();
        $cartItem->delete();

        return response()->json(['message' => 'Item removed from cart'], 200);
    }

    // Clear the cart
    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        return response()->json(['message' => 'Cart cleared'], 200);
    }
}
