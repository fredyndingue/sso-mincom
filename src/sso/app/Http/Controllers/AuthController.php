<?php

namespace App\Http\Controllers;
use Socialite;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function redirectToGoogle()
{
   return Socialite::driver('google')->redirect();
}

public function handleGoogleCallback()
{
   $user = Socialite::driver('google')->user();
   // Check if the user exists in your system based on their email or other unique identifier.
   // If not, create a new user account.
   // Log in the user using JWT or other authentication method.
}

    /**
     * Redirect the user to the OAuth provider.
     *
     * @param  string  $provider
     * @return array
     */
    public function redirectToProvider($provider)
    {
        return [
            'url' => Socialite::driver($provider)->stateless()->redirect()->getTargetUrl(),
        ];
    }

    /**
     * Handle the OAuth provider callback.
     *
     * @param  string  $provider
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function handleProviderCallback($provider)
    {
        // Retrieve user information from the OAuth provider
        $user = Socialite::driver($provider)->stateless()->user();

        // Find or create the user in your application
        $user = $this->findOrCreateUser($provider, $user);

        // Generate a JWT token for the user
        $this->guard()->setToken($token = $this->guard()->login($user));

        // Log the authentication event if it needed
        // AuthenticationLog::log(
        //    isset($user->email) ? $user->email : Str::substr(json_encode($user), 50),
        //    ($provider && is_string($provider) ? $provider : 'OAuth')
        // );

        // Return a response with the token and user information
        return view('oauth/callback', [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->getPayload()->get('exp') - time(),
            'user'  => $user
        ]);
    }

    // ...

    /**
     * Find or create a user based on OAuth provider data.
     *
     * @param  string  $provider
     * @param  \Laravel\Socialite\Contracts\User  $user
     * @return \App\User
     * @throws \App\Exceptions\EmailTakenException
     */
    protected function findOrCreateUser($provider, $user)
    {
        $oauthProvider = OAuthProvider::where('provider', $provider)
            ->where('provider_user_id', $user->getId())
            ->first();

        if ($oauthProvider) {
            // Update the access and refresh tokens if needed
            $oauthProvider->update([
                'access_token' => $user->token,
                'refresh_token' => $user->refreshToken,
            ]);

            return $oauthProvider->user;
        }

        if (User::where('email', $user->getEmail())->exists()) {
            // Handle the case where the email is already taken
            throw new EmailTakenException();
        }

        // Create a new user and associated OAuthProvider entry
        return $this->createUser($provider, $user);
    }

    /**
     * Create a new user and associated OAuthProvider entry.
     *
     * @param  string  $provider
     * @param  \Laravel\Socialite\Contracts\User  $sUser
     * @return \App\User
     */
    protected function createUser($provider, $sUser)
    {
        $user = User::create([
            'name' => $sUser->getName(),
            'email' => $sUser->getEmail(),
        ]);

        $user->oauthProviders()->create([
            'provider' => $provider,
            'provider_user_id' => $sUser->getId(),
            'access_token' => $sUser->token,
            'refresh_token' => $sUser->refreshToken,
        ]);

        return $user;
    }

    // ...
    public function index(){
        return view('portal');
    }

}
