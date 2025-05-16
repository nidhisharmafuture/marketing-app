<?php

namespace Modules\AdminModule\Http\Controllers\admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Faker\Core\Uuid;



class TeamController extends Controller
{
    public function teamList()
    {
        $teams = Team::latest()->get();
        return view('adminmodule::admin.teams.index', compact('teams'));
    }

    public function teamCreate()
    {
        return view('adminmodule::admin.teams.create');
    }

    public function teamStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:teams,name',
        ]);

        Team::create([
            'name' => $request->name,
            'status' => true,
        ]);

        return redirect()->route('admin.team.list')->with('success', 'Team created successfully.');
    }

    public function teamEdit($id)
    {
        $team = Team::findOrFail($id);
        return view('adminmodule::admin.teams.edit', compact('team'));
    }

    public function teamUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:teams,name,' . $id,
        ]);

        $team = Team::findOrFail($id);
        $team->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.team.list')->with('success', 'Team updated successfully.');
    }

    public function teamDestroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return redirect()->route('admin.team.list')->with('success', 'Team deleted successfully.');
    }

    public function teamShow($id)
    {
        $team = Team::findOrFail($id);
        return view('adminmodule::admin.teams.show', compact('team'));
    }

    public function teamPublishStatus($id)
    {
        $team = Team::findOrFail($id);
        $team->status = !$team->status;
        $team->save();

        return response()->json([
            'success' => true,
            'status' => $team->status
        ]);
    }

}
