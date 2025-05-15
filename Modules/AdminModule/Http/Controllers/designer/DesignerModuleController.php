<?php

namespace Modules\AdminModule\Http\Controllers\designer;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class DesignerModuleController extends Controller
{
    /**
     * Display the designer login page.
     * @return Renderable
     */
    public function designerLoginPage()
    {
        return view('adminmodule::designer.login.designerlogin');
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
        } else {
            return redirect()->route('designer.loginPage')->with('error', 'Unauthorized access.');
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
