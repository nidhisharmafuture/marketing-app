<?php

namespace Modules\AdminModule\Http\Controllers\admin;

use App\Models\Category;
use App\Models\Media;
use App\Models\Team;
use App\Models\Township;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Faker\Core\Uuid;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


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


    // Group user creation by month
    $monthlyStats = User::whereIn('role', [0, 2])
    ->whereStatus(1)
    ->select(
        DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
        DB::raw("SUM(CASE WHEN role = 0 THEN 1 ELSE 0 END) as associates"),
        DB::raw("SUM(CASE WHEN role = 2 THEN 1 ELSE 0 END) as designers")
    )
    ->groupBy('month')
    ->orderBy('month', 'asc')
    ->get();

        // Separate arrays for chart
        $months = $monthlyStats->pluck('month')->toArray();
        $associateCounts = $monthlyStats->pluck('associates')->toArray();
        $designerCounts = $monthlyStats->pluck('designers')->toArray();




            if ($user->role == 1) {



    return view('adminmodule::admin.dashboard.dashboard', [
       'totalDesigners' => User::where('role', 2)->whereStatus(1)->count(),

        'recentDesigners' => User::where('role', 2)->whereStatus(1)->latest()->take(5)->get(),
        'totalMedia' => Media::whereStatus(1)->count(),
        'recentMedia' => Media::whereStatus(1)->latest()->take(5)->get(),
        'totalTeams' => Team::whereStatus(1)->count(),
        'recentTeams' => Team::whereStatus(1)->latest()->take(5)->get(),
        'totalTownships' => Township::whereStatus(1)->count(),
        'recentTownships' => Township::whereStatus(1)->latest()->take(5)->get(),
        'totalAssociates' => User::whereStatus(1)->where('role', 0)->count(),
        'recentAssociates' => User::whereStatus(1)->where('role', 0)->latest()->take(5)->get(),
        'totalCategories' => Category::whereStatus(1)->count(),
        'recentCategories' => Category::whereStatus(1)->latest()->take(5)->get(),
         'months' => $months,
    'associateCounts' => $associateCounts,
    'designerCounts' => $designerCounts,
    ]);





                // return redirect()->route('admin.dashboard')->with('message', 'Login Successfully');
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

  $monthlyStats = User::whereIn('role', [0, 2])
    ->whereStatus(1)
    ->select(
        DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
        DB::raw("SUM(CASE WHEN role = 0 THEN 1 ELSE 0 END) as associates"),
        DB::raw("SUM(CASE WHEN role = 2 THEN 1 ELSE 0 END) as designers")
    )
    ->groupBy('month')
    ->orderBy('month', 'asc')
    ->get();

        // Separate arrays for chart
        $months = $monthlyStats->pluck('month')->toArray();
        $associateCounts = $monthlyStats->pluck('associates')->toArray();
        $designerCounts = $monthlyStats->pluck('designers')->toArray();








            return view('adminmodule::admin.dashboard.dashboard', [
       'totalDesigners' => User::where('role', 2)->whereStatus(1)->count(),

        'recentDesigners' => User::where('role', 2)->whereStatus(1)->latest()->take(5)->get(),
        'totalMedia' => Media::whereStatus(1)->count(),
        'recentMedia' => Media::whereStatus(1)->latest()->take(5)->get(),
        'totalTeams' => Team::whereStatus(1)->count(),
        'recentTeams' => Team::whereStatus(1)->latest()->take(5)->get(),
        'totalTownships' => Township::whereStatus(1)->count(),
        'recentTownships' => Township::whereStatus(1)->latest()->take(5)->get(),
        'totalAssociates' => User::whereStatus(1)->where('role', 0)->count(),
        'recentAssociates' => User::whereStatus(1)->where('role', 0)->latest()->take(5)->get(),
        'totalCategories' => Category::whereStatus(1)->count(),
        'recentCategories' => Category::whereStatus(1)->latest()->take(5)->get(),
         'months' => $months,
    'associateCounts' => $associateCounts,
    'designerCounts' => $designerCounts,
    ]);
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
