<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\LoginLog;
use App\Models\Classroom;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return response()->json([
            'message' => 'List of users',
            'data' => $users
        ], 200);

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

    public function store(Request $request)
    {
        $user = User::store($request);
        return $user;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('id', $id)->first();

        if ($user) {
            return response()->json(['success' => true, 'data' => $user], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }
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
        $user = User::store($request, $id);
        return $user;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }

    public function getStudents()
    {
        $students = User::with('classroom:id,name') // Only fetch the classroom id and name
                    ->where('role', 2)
                    ->get()
                    ->map(function ($student) {
                        // Flatten classroom attributes into the main student object
                        if ($student->classroom) {
                            $student->classroom_name = $student->classroom->name;
                        }
                        unset($student->classroom); // Remove the original classroom object
                        return $student;
                    });

        // Check if no students found
        if ($students->isEmpty()) {
            return response()->json(['message' => 'Students not found'], 404);
        }

        // Return the list of students
        return response()->json([
            'message' => 'List of students',
            'data' => $students
        ], 200);
    }

}
