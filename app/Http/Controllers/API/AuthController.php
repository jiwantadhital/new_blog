<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function register(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:10',
            // 'phone' => 'required|unique:students',
        ]);
        // Return errors if validation error occur.
        if ($validator->fails()) {
            $errors = $validator->errors();
            $formatted_error = $errors->first();
            return response()->json([
                'message' => $formatted_error
            ], 400);
        }
        // Check if validation pass then create user and auth token. Return the auth token
        if ($validator->passes()) {
            $randomId =   rand(1000,9999);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type' => $request->user_type
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;            
            return response()->json([
            'token' => $token,
            'message' => "successfull",
            'user_type' => $user->user_type,
            'user_id' => $user->id,
            'user_email' => $user->email
            ]);
        }
        else{
            return response()->json([
                'message' => "failed",
                ]);
            }
        }

        //login
        public function login(Request $request)
{
    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
            'message' => 'Invalid login details'
        ], 400);
    }

    $user = User::where('email', $request['email'])->firstOrFail();
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'message' => "successfull",
        'user_id' => auth()->user()->id,
        'user_name' => auth()->user()->name,
        'user_type' => auth()->user()->user_type,
        'user_email' => auth()->user()->email
    ]);
}


}