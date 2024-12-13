<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request){
        $find = User::where('email', $request->email)->first();
        if($find){
            return response()->json(['message' => 'User already exists'], 400);
        } else {
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            return response()->json($user, 200);
        }
    }

    // Token-based authentication --------------------------------------------------------------------------
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            Log::error("JWT Error: " . $e->getMessage());  
            return response()->json(['message' => 'Could not create token'], 500);
        }
    
        return response()->json(['token' => $token], 200);
    }

    public function logout(Request $request){
        try {
            $token = JWTAuth::getToken();
            JWTAuth::invalidate($token);
            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (JWTException $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Failed to log out, please try again'], 500);
        }
    }

    public function user(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            return response()->json(['user' => $user], 200);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Token is invalid'], 401);
        }
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|min:8',
    //     ]);

    //     $user = User::where('email', $request->email)->first();
    
    //     if (!$user || !Hash::check($request->password, $user->password)) {
    //         return response()->json(['message' => 'Invalid credentials'], 401);
    //     }
        
    //     try {
    //         $token = JWTAuth::fromUser($user);
    //     } catch (JWTException $e) {
    //         return response()->json(['message' => 'Could not create token'], 500);
    //     }
    
    //     return response()->json(['token' => $token], 200);
    // }

    // public function logout(Request $request)
    // {
    //     $request->user()->tokens()->delete();

    //     return response()->json(['message' => 'Logged out'], 200);
    // }

    // Session-based authentication --------------------------------------------------------------------------
    public function login2(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(['message' => 'Login successful'], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout2 (Request $request)
    {
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 

        return response()->json(['message' => 'Logged out'], 200);
    }

    public function user2(Request $request)
    {
        return response()->json(['user' => Auth::user()], 200); // Trả về thông tin người dùng
    }
}
