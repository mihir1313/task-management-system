<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

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
    public function index(){
        return view('auth.login');
    }

    public function login(Request $request)
    {
     
        $credentials = $request->only('email', 'password');
        $role = $request->input('role'); 

        if (Auth::attempt(array_merge($credentials, ['role' => $role]))) {
            if ($role === 'admin') {
               
                $user = Auth::user();

                $token = $user->createToken('taskmanagement')->plainTextToken;
        
                // Optionally, you can return the token as a response
                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'redirect' => $role === 'admin' ? '/admin/dashboard' : route('admin.dashboard'),
                ]);
                // return redirect('/admin/dashboard');
            } elseif ($role === 'user') {
                
                $user = Auth::user();

                $token = $user->createToken('taskmanagement')->plainTextToken;
                
                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'redirect' => $role === 'user' ? '/user/dashboard' : route('user.dashboard'),
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'error' => 'Invalid email or password.'
        ]);
    }
    public function logout(Request $request)
{
    Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
}
}
