<?php

namespace Modules\AdminModule\Http\Controllers\admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Faker\Core\Uuid;



class AdminModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function adminLoginPage()
    {
        return view('adminmodule::admin.login.adminlogin');
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
                Auth::logout(); // Prevent access if not authorized
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

    public function dashboardPage()
    {
        if (Auth::check() && auth()->user()->role == '1') {

            return view('adminmodule::common.dashboard');
        }
    }
    public function profilePage()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $id = $user->id;
            $Admin = User::where('id', $id)->first();
            return view('adminmodule::common.profilepage', ['admin' => $Admin]);
        }
    }

    public function updateProfile(Request $request)
    {
        $admin = User::findOrFail($request->adminId);
        $admin->name = $request->name;
        $admin->phone = $request->phone;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin'), $filename);
            $admin->image = $filename;
        }

        $admin->save();

        return response()->json(['success' => true]);
    }

    public function changePassword(Request $request)
    {
        // Define the validation rules
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'currentpassword' => 'required', // The current password is required
            'newpassword' => 'required|min:6', // New password is required and must be at least 8 characters
            'confirmpassword' => 'required|same:newpassword', // Confirm password must match the new password
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors() // Return validation errors
            ]);
        }

        // Check if the current password is correct
        if (!Hash::check($request->currentpassword, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect.'
            ]);
        }

        // Proceed to update the password

        $user->password = Hash::make($request->newpassword);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully.'
        ]);
    }

   

}
