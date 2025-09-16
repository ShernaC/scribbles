<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController
{
    public function showRegister ()
    {
        return view('auth.register');
    }

    public function showLogin () 
    {
        // dump(Carbon::now()->format('d F Y'));
        // dump(Carbon::now()->addWeeks(2)->format('d F Y'));
        return view('auth.login');
    }

    public function register (RegisterRequest $request)
    {
        // validate user input
        $validated = $request->validated();
        $user = User::create($validated);

        event(new UserRegistered($user));
        
        Auth::login($user);

        // UserRegistered::dispatch($user);

        return redirect()->route('home');
    }

    public function login (LoginRequest $request) 
    {
        if (Auth::attempt($request->validated())) { //attempt to login
            $request->session()->regenerate();

            return redirect()->route('home');
        } 

        throw ValidationException::withMessages([
            'credentials' => 'invalid email or password'
        ]);
    }

    public function logout (Request $request)
    {
        Auth::logout(); // removes user data but not session data

        $request->session()->invalidate(); // clear the rest of the sessiond data
        $request->session()->regenerateToken();
        // $request->session()->flash('success', 'test');

        return redirect()->route('home')->with('success', 'successfully logged out');
    }

    public function ShowForgotPassword () {
        return view('auth.forgot-password');
    }

    public function sendResetPasswordEmail(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent 
            ? redirect()->route('password.sent')->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showSentResetEmail() {
        return view('auth.reset-password-email');
    }

    public function showResetPassword(string $token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function(User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password) 
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function verifyEmail() {
        return view('auth.verify-email');
    }

    public function requestEmailVerification(EmailVerificationRequest $request) {
        $request->fulfill(); // calls the markEmailAsVerified method + dispatch event 

        return redirect('/home');
    }

    public function resendEmailVerificationRequest(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'verification link sent.');
    }
}

