<?php

namespace Modules\AdminModule\Http\Controllers\admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Media;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Faker\Core\Uuid;



class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
  
    public function mediaList()
    {
        $media = Media::all();
        return view('adminmodule::admin.media.index', compact('media'));
    }

    public function mediaCreate()
{
    return view('adminmodule::admin.media.create');
}

public function mediaStore(Request $request)
{
    $auth = Auth::user()->id;
    $request->validate([
        'title' => 'required|string',
        
      
    ]);

    Media::create([
        'title' => $request->title,
        'status' => 1,
        'admin' => $auth,
    
    ]);

    return redirect()->route('admin.media.list')->with('success', 'Media created successfully.');
}

public function mediaEdit($id)
{
    $media = Media::findOrFail($id);
    return view('adminmodule::admin.media.edit', compact('media'));
}

public function mediaUpdate(Request $request, $id)
{
    $media = Media::findOrFail($id);

    $request->validate([
        'title' => 'required|string',
       
    ]);

    $media->update([
        'title' => $request->title,
       
    ]);

    return redirect()->route('admin.media.list')->with('success', 'Media updated successfully.');
}

public function mediaDestroy($id)
{
    $media = Media::findOrFail($id);
    $media->delete();

    return redirect()->route('admin.media.list')->with('success', 'Media deleted.');
}

public function mediaShow($id)
{
    $media = Media::findOrFail($id);
    return view('adminmodule::admin.media.show', compact('media'));
}

 public function mediaPublishStatus($id)
    {
        $media = Media::findOrFail($id);
        $media->status = !$media->status;
        $media->save();

        return response()->json([
            'success' => true,
            'status' => $media->status
        ]);
    }

}
