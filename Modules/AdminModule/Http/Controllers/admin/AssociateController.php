<?php

namespace Modules\AdminModule\Http\Controllers\admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Faker\Core\Uuid;



class AssociateController extends Controller
{
    public function associateList()
    {
        $associates = User::where('role', 0)->get();
        return view('adminmodule::admin.associates.index', compact('associates'));
    }

    // Show edit form
    public function associateEdit($id)
    {
        $associate = User::findOrFail($id);
        return view('adminmodule::admin.associates.edit', compact('associate'));
    }

    // Update associate
    public function associateUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'rera_no' => 'nullable|string|max:255',
        ]);

        $associate = User::findOrFail($id);
        $associate->update($request->only(['name', 'email', 'phone', 'rera_no']));

        return redirect()->route('admin.associate.list')->with('success', 'Associate updated successfully.');
    }

    // Toggle associate active/inactive
    public function associateStatusUpdate($id)
    {
        $associate = User::findOrFail($id);
        $associate->status = $associate->status == 1 ? 0 : 1;
        $associate->save();

        return response()->json(['success' => true, 'status' => $associate->status]);
    }

    // View details
    public function associateShow($id)
    {
        $associate = User::findOrFail($id);
        return view('adminmodule::admin.associates.show', compact('associate'));
    }

}
