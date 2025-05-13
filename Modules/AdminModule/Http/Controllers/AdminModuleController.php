<?php

namespace Modules\AdminModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class AdminModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function adminLoginPage()
    {
        return view('adminmodule::adminlogin');
    }

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
        
            if ($user->role == 1) {
                return redirect()->route('admin.dashboard')->with('message', 'Login Successfully');
            } else {
                return back()->with('error', 'You do not have permission to access this dashboard.');
            }
        } else {
            return back()->with('error', 'Invalid credentials');
        }
        
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.loginPage')->with('message', 'Successfully Logout');
    }

    public function dashboardPage(){
    if (Auth::check() && auth()->user()->role == '1') {

        return view('adminmodule::dashoard');

    }
   }
}
