<?php

namespace Modules\AdminModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DesignerModuleController extends Controller
{
    /**
     * Display the designer login page.
     * @return Renderable
     */
    public function designerLoginPage()
    {
        return view('adminmodule::designer.designerlogin');
    }

    /**
     * Handle the login process.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginProcess(Request $request)
{
    $customMessages = [
        'email.required' => 'Email is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.exists' => 'Invalid credentials.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 4 characters.',
    ];

    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|string|min:4',
    ], $customMessages);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->role == 2) {
            return redirect()->route('designer.dashboard')->with('message', 'Login Successfully');
        } else {
            Auth::logout(); // Prevent access if not authorized
            return back()->with('error', 'You do not have permission to access this dashboard.');
        }
    } else {
        return back()->with('error', 'Invalid credentials');
    }
}


    /**
     * Log out the user.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('designer.loginPage')->with('message', 'Successfully logged out.');
    }

    /**
     * Display the designer dashboard page.
     * @return Renderable
     */
    public function dashboardPage()
    {
        if (Auth::check() && auth()->user()->role == 2) {
            return view('adminmodule::common.dashboard');
        } 
        

        else {
            return redirect()->route('designer.loginPage')->with('error', 'Unauthorized access.');
        }
    }
}
