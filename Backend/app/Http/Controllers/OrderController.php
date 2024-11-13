<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favorites = Order::where('user_id', Auth::id())->with('course')->get();

        // Extract course information from each favorite item
        $courses = $favorites->pluck('course')->unique('id')->values();

        // Remove the nested course data from each favorite item
        $favorites = $favorites->map(function ($favorite) {
            return collect($favorite)->except(['course']);
        });

        return response()->json([
            'message' => 'List of favorite items for user',
            // 'favorites' => $favorites,
            'courses' => $courses
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
