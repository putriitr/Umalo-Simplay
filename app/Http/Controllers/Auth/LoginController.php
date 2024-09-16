<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your  screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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

            // Get the authenticated user
            $user = auth()->user();

            // Check the user's type and redirect accordingly
            if ($user->type == 'admin') {
                return redirect()->route('dashboard');
            } else if ($user->type == 'member') {
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
    $user = Auth::user();  // Capture the user before logging out

    Auth::logout();  // Log the user out
    $request->session()->invalidate();  // Invalidate the session
    $request->session()->regenerateToken();  // Regenerate the CSRF token

    // Redirect based on user role
    if ($user->role == 'admin') {
        return redirect('/login');  // Redirect admin users to the login page
    } elseif ($user->role == 'member') {
        return redirect('/');  // Redirect customer users to the  page
    }

    return redirect('/');  // Fallback to  for other roles
}
}
