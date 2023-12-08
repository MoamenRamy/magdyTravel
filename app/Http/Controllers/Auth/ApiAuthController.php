<?php

namespace App\Http\Controllers\Auth;

use App\Events\RevokeUserTokens;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        // Implement login logic using Jetstream
        // You can use the Jetstream login method or customize as needed
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            event(new RevokeUserTokens(auth()->user()->id));
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json(['token' => $token ,'user_id' => $user->id]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'address' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = \Password::sendResetLink(
            $request->only('email')
        );

        return $status === \Password::RESET_LINK_SENT
            ? response()->json(['message' => __($status)])
            : response()->json(['message' => __($status)], 400);
    }

    public function confirmPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (Hash::check($request->password, $user->password)) {
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Password confirmation failed'], 401);
    }

    // public function logout()
    // {
    //     // Your logout logic here

    //     // Dispatch the event to revoke user tokens
    //     event(new RevokeUserTokens(auth()->user()->id));

    //     return response()->json(['message' => 'Logged out successfully']);
    // }
}
