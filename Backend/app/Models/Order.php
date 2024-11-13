<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'course_id',
        'total_amount',
        'price',
        'status',
    ];

    public static function store($request, $id = null)
    {
        // Check if the user is authenticated
        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $favorites = $request->only(
            'course_id',
            'total_amount',
            'price',
            'status',
        );
        
        $favorites['user_id'] = $userId;

        if ($id) {
            $favorite = self::find($id);
            if (!$favorite) {
                return response()->json(['error' => 'Record not found'], 404);
            }
            $favorite->update($favorites);
        } else {
            $favorite = self::create($favorites);
            $id = $favorite->$id;
        }
        return response()->json(['success' => true, 'data' => $favorite], 201);
    }
}
