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



class DesignerFileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
  
    public function designerList()
    {
        $designers = User::where('role', 2)->get();
        return view('adminmodule::admin.user.index', compact('designers'));
    }

    public function designerCreate()
{
    return view('adminmodule::admin.user.create');
}

public function designerStore(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'contact' => 'nullable|string',
        'password' => 'required|string|min:6|confirmed',
    ]);

    User::create([
        'uid' => Str::uuid(), // 👈 This now works
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->contact, // or use 'contact' if that's your DB column
        'password' => Hash::make($request->password),
        'role' => 2,
        'status' => 1,
    ]);

    return redirect()->route('admin.designer.list')->with('success', 'Designer created successfully.');
}

public function designerEdit($id)
{
    $designer = User::findOrFail($id);
    return view('adminmodule::admin.user.edit', compact('designer'));
}

public function designerUpdate(Request $request, $id)
{
    $designer = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email,' . $designer->id,
        'phone' => 'nullable|string',
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    $designer->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->contact,
        'password' => $request->password ? Hash::make($request->password) : $designer->password,
    ]);

    return redirect()->route('admin.designer.list')->with('success', 'Designer updated successfully.');
}

public function designerDestroy($id)
{
    $designer = User::findOrFail($id);
    $designer->delete();

    return redirect()->route('admin.designer.list')->with('success', 'Designer deleted.');
}

public function designerShow($id)
{
    $designer = User::where('role', 2)->findOrFail($id);
    return view('adminmodule::admin.user.show', compact('designer'));
}

  public function designerStatusUpdate($id)
    {
        $associate = User::findOrFail($id);
        $associate->status = $associate->status == 1 ? 0 : 1;
        $associate->save();

        return response()->json(['success' => true, 'status' => $associate->status]);
    }

}
