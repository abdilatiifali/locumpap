<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Login', [
            'loginImage' => asset('/man-applying-job.jpeg')
        ]);
    }

    public function register()
    {
        return Inertia::render('Auth/Register');
    }

    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return Inertia::location(redirect()->intended(RouteServiceProvider::HOME));
    }

    public function destory()
    {
        \Auth::guard('web')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return Inertia::location('/');
    }

    public function forgot()
    {
        return Inertia::render('Auth/ForgotPassword');
    }

    public function reset()
    {
       request()->validate([
            'email' => 'required|email'
       ]);

       $status = Password::sendResetLink(request()->only('email'));

       return $status === Password::RESET_LINK_SENT
                ? redirect()->route('password.email')->with('status',  __($status))
                : back()->withErrors(['email' => __($status)]);
    }

    public function update(Request $request)
    {
       $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
 
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
        
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
