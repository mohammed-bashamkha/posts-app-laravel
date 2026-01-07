<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function register(Request $request) {
        Log::info('Attempting User Registration',[
            'Requested Data' => $request->only('name','email')
        ]);
        try
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|string|max:255|unique:users,email',
                'password' => 'required|string|min:8'
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return response()->json([
                'massage' => 'User Registered Successfuly',
                'User' => $user,
            ],201);
        }
        catch(\Exception $e)
        {
            Log::error('Registration Failed',[
                'Error' => $e->getMessage()
            ]);
            return response()->json([
                'Message' => 'Registration Failed. User Is Registered Before!',
                'Error' => $e->getMessage()
            ]);
        }
    }

    public function login(Request $request) {
        Log::info('Attempting User Login',[
            'Requested Data' => $request->only('name','email')
        ]);
        try
        {
            $request->validate([
                'email' => 'required|email|string|max:255',
                'password' => 'required|string|min:8'
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'The provided credentials are incorrect.'], 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            Log::info(' User Logged In Successfully',[
                'Requested Data' => $request->only('name','email'),
                'User Token' => $token
            ]);

            return response()->json([
                'message' => 'User Logged In Successfully',
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 200);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'Message' => 'Login Failed.',
                'Error' => $e->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        try
        {
            $user = $request->user();

            if ($user && $user->currentAccessToken()) {
                $user->currentAccessToken()->delete();

                Log::info('logged out successfully',[
                    'Requested Data' => $user->only('name','email')
                ]);

                return response()->json(['message' => 'logged out successfully'], 200);
            }

            return response()->json(['message' => 'The currentAccessToken is Undefiend'], 401);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'Message' => 'Logout Failed.',
                'Error' => $e->getMessage()
            ]);
        }
    }
}
