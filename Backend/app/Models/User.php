<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'phone_number',
        'gender',
        'address',
        'date_of_birth',
        'profile',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // JWT methods for User model
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    public static function store($request, $id = null)
    {

        $requestData = $request->only(
            'id',
            'username',
            'gender',
            'date_of_birth',
            'phone_number',
            'address',
            'profile',
            'email',
            'password'
        );

        $request->validate([
            'profile' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);
        // Process profile image
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $path = asset('images/' . $new_name);
            $requestData['profile'] = $path;
        } else {
            // Retain the existing profile if no new file is uploaded
            if ($id) {
                unset($requestData['profile']);
            }
        }

        if ($id) {
            $user = self::find($id);
            if (!$user) {
                return response()->json(['error' => 'Record not found'], 404);
            }

            $user->update($requestData);
        } else {

            if ($request->has('email') && self::where('email', $request->input('email'))->exists()) {
                return response()->json(['error' => 'Email is already taken'], 422);
            }

            $password = Str::random(8);
            $requestData['password'] = bcrypt($password);

            $user = self::create($requestData);
            $id = $user->$id;

            // // Send an email notification to the user
            // Mail::send('email.new_user', ['user' => $user, 'password' => $password], function ($message) use ($user) {
            //     $message->to($user->email, $user->first_name)->subject('Welcome to our system!');
            // });
        }

        return response()->json(['success' => true, 'data' => $user], 201);
    }


    public function favorites()
    {
        return $this->belongsToMany(Course::class, 'favorites');
    }
    

}
