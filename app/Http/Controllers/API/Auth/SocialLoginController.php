<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\OrderNotification;
use App\Notifications\UserRegistrationNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller {
    public function RedirectToProvider($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function HandleProviderCallback($provider) {
        $socialUser = Socialite::driver($provider)->stateless()->user();
        dd( $socialUser);
    }

    public function SocialLogin(Request $request) {
        $request->validate([
            'token'    => 'required',
            'provider' => 'required|in:google,facebook,apple',
            'role' => 'required|in:customer,contractor',
        ]);

        try {
            $provider   = $request->provider;
            $socialUser = Socialite::driver($provider)->stateless()->userFromToken($request->token);
            // return response()->json($socialUser);

            if ($socialUser) {
                $user      = User::where('email', $socialUser->email)->first();
                
                $isNewUser = false;

                if (!$user) {
                    $password = Str::random(16);
                    $user     = User::create([
                        'name'              => $socialUser->getName(),
                        'email'             => $socialUser->getEmail(),
                        'password'          => bcrypt($password),
                        'avatar'            => $socialUser->getAvatar(),
                        'role'              => $request->role,
                        'email_verified_at' => now(),
                    ]);
                    $isNewUser = true;
                }

                Auth::login($user);
                $token = auth('api')->login($user);

                return response()->json([
                    'status'     => true,
                    'message'    => 'User logged in successfully.',
                    'code'       => 200,
                    'token_type' => 'bearer',
                    'token'      => $token,
                    'expires_in' => auth('api')->factory()->getTTL() * 60,
                    'data' => $user
                ],200);
            } else {
                return Helper::jsonResponse(false, 'Unauthorized', 401);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Something went wrong', 500, ['error' => $e->getMessage()]);
        }
    }
}
