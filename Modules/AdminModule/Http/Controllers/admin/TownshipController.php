<?php

namespace Modules\AdminModule\Http\Controllers\admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Township;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Faker\Core\Uuid;



class TownshipController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function townshipList()
    {
        $townships = Township::latest()->get();
        return view('adminmodule::admin.townships.index', compact('townships'));
    }

    // Show create form
    public function townshipCreate()
    {
        return view('adminmodule::admin.townships.create');
    }

    // Store new township
    public function townshipStore(Request $request)
    {
        $auth = AUTH::user()->id;

        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'rera_no' => 'nullable|string|max:255',
        ]);

        Township::create([
            'name' => $request->name,
            'location' => $request->location,
            'district' => $request->district,
            'project_type' => $request->project_type,
            'rera_no' => $request->rera_no,
            'admin_id' => $auth,
            'status' => true,
        ]);

        return redirect()->route('admin.township.list')->with('success', 'Township created successfully.');
    }

    // Show edit form
    public function townshipEdit($id)
    {
        $township = Township::findOrFail($id);
        return view('adminmodule::admin.townships.edit', compact('township'));
    }

    // Update township
    public function townshipUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'rera_no' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'project_type' => 'nullable|string|max:255',


        ]);

        $township = Township::findOrFail($id);
        $township->update([
            'name' => $request->name,
            'location' => $request->location,
            'rera_no' => $request->rera_no,
            'project_type' => $request->project_type,
            'district' => $request->district,

        ]);

        return redirect()->route('admin.township.list')->with('success', 'Township updated successfully.');
    }

    // Delete township
    public function townshipDestroy($id)
    {
        $township = Township::findOrFail($id);
        $township->delete();

        return redirect()->route('admin.township.list')->with('success', 'Township deleted successfully.');
    }

    // Show details page (optional)
    public function townshipShow($id)
    {
        $township = Township::findOrFail($id);
        return view('adminmodule::admin.townships.show', compact('township'));
    }

    // Toggle publish status
    public function townshipPublishStatus($id)
    {
        $township = Township::findOrFail($id);
        $township->status = !$township->status;
        $township->save();

        return response()->json([
            'success' => true,
            'status' => $township->status
        ]);
    }

    public function ajaxTownshipTable()
    {
        $townships = Township::latest()->get();

        return view('adminmodule::admin.townships.list', compact('townships'));
    }
}
