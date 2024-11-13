<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
    ];

    public static function store($request, $id = null)
    {
        $carts = $request->only(
            'id',
            'course_id'
        );

        $carts['user_id'] = auth()->id();
        // Check if a cart item with the same user_id and course_id already exists
        $existingCart = self::where('user_id', $carts['user_id'])
            ->where('course_id', $carts['course_id'])
            ->first();

        if ($existingCart) {
            return response()->json(['error' => 'This item is already in the cart'], 409);
        }
        
        if ($id) {
            $cart = self::find($id);
            if (!$cart) {
                return response()->json(['error' => 'Record not found'], 404);
            }
            $cart->update($carts);
        } else {
            $cart = self::create($carts);
            $id = $cart->$id;
        }
        return response()->json(['success' => true, 'data' => $cart], 201);
    }


    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
