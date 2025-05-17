<?php

namespace Modules\AdminModule\Http\Controllers\designer;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // ADD THIS

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Task;
use App\Models\Township;
use App\Models\Category;
use App\Models\Media;


use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
      use AuthorizesRequests; 
    

     public function taskList()
    {
        $tasks = Task::where('designer_id', auth()->id())->latest()->get();
        return view('adminmodule::designer.tasks.index', compact('tasks'));
    }

    public function taskCreate()
    {
        $townships = Township::whereStatus(1)->get();
        $categories = Category::whereStatus(1)->get();
        $media = Media::whereStatus(1)->get();
        

        return view('adminmodule::designer.tasks.create', compact('townships', 'categories', 'media'));
    }

    public function taskStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'township_id' => 'required|exists:townships,id',
            'category_id' => 'required|exists:categories,id',
            'media_type' => 'required|string',
            'file_path' => 'required|file',
        ]);

        $path = $request->file('file_path')->store('tasks', 'public');
        

       $task =  Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'designer_id' => auth()->id(),
            'township_id' => $request->township_id,
            'category_id' => $request->category_id,
            'media_type' => $request->media_type,
            'file_path' => $path,
            'status' => 1,
            'publish_status' => 0,
        ]);


        if ($request->hasFile('file_path')) {

    // Delete old file if exists
    $oldFile = public_path('tasks/' . $task->file_path);
   

    // Upload new file
    $image = $request->file('file_path');
    $filename = time() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('tasks'), $filename);

    // Update path
    $task->file_path = $filename;
}
$task->save(); 


        return redirect()->route('designer.tasks.index')->with('success', 'Task submitted successfully!');
    }

    public function taskEdit($task)
    {

       $task = Task::where('id', $task)->first();


        $townships = Township::whereStatus(1)->get();
        $categories = Category::whereStatus(1)->get();
                $media = Media::whereStatus(1)->get();

        return view('adminmodule::designer.tasks.edit', compact('task', 'townships', 'categories', 'media'));
    }

    public function taskUpdate(Request $request, $task)
    {
               $task = Task::where('id', $task)->first();


        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'township_id' => 'required|exists:townships,id',
            'category_id' => 'required|exists:categories,id',
            'media_type' => 'required|string',
            'file_path' => 'nullable|file',
        ]);

    //   if ($request->hasFile('file_path')) {
    //     // Delete old file
    //     if ($task->file_path && Storage::disk('public')->exists($task->file_path)) {
    //         Storage::disk('public')->delete($task->file_path);
    //     }

    //     // Store new file
    //     $path = $request->file('file_path')->store('tasks', 'public');
    //     $task->file_path = $path;
    // }

   if ($request->hasFile('file_path')) {

    // Delete old file if exists
    $oldFile = public_path('tasks/' . $task->file_path);
    if ($task->file_path && file_exists($oldFile)) {
        unlink($oldFile);
    }

    // Upload new file
    $image = $request->file('file_path');
    $filename = time() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('tasks'), $filename);

    // Update path
    $task->file_path = $filename;
}


    // Update task fields
    $task->update([
        'title' => $request->title,
        'description' => $request->description,
        'township_id' => $request->township_id,
        'category_id' => $request->category_id,
        'media_type' => $request->media_type,
        'file_path' => $task->file_path, // keep updated or old path
    ]);

        return redirect()->route('designer.tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy($task)
    {

          $task = Task::where('id', $task)->first();
        Storage::disk('public')->delete($task->file_path);
        $task->delete();
        return back()->with('success', 'Task deleted.');
    }

    public function changeStatus(Task $task)
    {
        $task->publish_status = !$task->publish_status;
        $task->save();
        return response()->json(['message' => 'Status updated.']);
    }

    public function showTask($id)
{
    $task = Task::with(['designer', 'township', 'category'])->findOrFail($id);
    return view('adminmodule::designer.tasks.show', compact('task'));
}

}
