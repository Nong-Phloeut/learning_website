<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Favorites::all();

        return response()->json([
            'message' => 'List of users',
            'data' => $users
        ], 200);
    }

    public function getByUserId()
    {
        // Get all favorite items for the user and load related courses
        $favorites = Favorites::where('user_id', Auth::id())->with('course')->get();

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
        $user = Favorites::store($request);
        return $user;
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
        $favorite = Favorites::where('course_id', $courseId)
                         ->where('user_id', auth()->id())
                         ->first();
        $favorite->delete();

        return response()->json(['message' => 'Item removed from favotie'], 200);
    }
}
