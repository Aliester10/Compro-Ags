<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        // Validate the request input
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->user();

            // If user is a distributor and not verified, log them out and redirect to waiting
            if ($user->type == 'distributor' && !$user->verified) {  // Type 0 represents a distributor
                auth()->logout();
                return redirect()->route('distributors.waiting')
                    ->with('info', 'Your account is awaiting approval. Please wait for admin verification.');
            }

            // Redirect based on user type
            // Redirect based on user type
            if ($user->type == 'admin') {
                return redirect()->route('dashboard');
            } elseif ($user->type == 'member') {
                return redirect('/');
            } elseif ($user->type == 'distributor') {
                return redirect('/');
            }
        } else {
            // Authentication failed
            return redirect()->route('login')
                ->with('error', 'Email or Password is incorrect.');
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($user->role == 'admin') {
            return redirect('/login');
        } elseif ($user->role == 'member') {
            return redirect('/');
        }

        return redirect('/');
    }
}
