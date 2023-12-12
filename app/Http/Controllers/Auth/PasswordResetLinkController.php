<?php

namespace App\Http\Controllers\Auth;

use App\Events\RevokeUserTokens;
use App\Http\Controllers\Controller;
use App\Mail\CustomResetPassword;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );


        // if ($status != Password::RESET_LINK_SENT) {
        //     throw ValidationException::withMessages([
        //         'email' => [__($status)],
        //     ]);
        // }

        // return response()->json(['status' => __($status)]);
        $user = User::where('email', $request->email)->first();
        event(new RevokeUserTokens($user->id));
        $token = $user->createToken('api-token')->plainTextToken;
        $url = url(config('app.url').route('password.reset', ['token' => $token], false));
        Mail::to($request->email)->send(new CustomResetPassword($url));
        return response()->json([
            'token' => $token,
            'user_id' => $user->id]);
    }
}
