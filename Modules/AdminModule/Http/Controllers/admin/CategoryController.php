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



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
  
    public function categoryList()
    {
        $categories = Category::all();
        return view('adminmodule::admin.category.index', compact('categories'));
    }

    public function categoryCreate()
{
    return view('adminmodule::admin.category.create');
}

public function categoryStore(Request $request)
{
    $auth = Auth::user()->id;
    $request->validate([
        'title' => 'required|string',
        
      
    ]);

    Category::create([
        'title' => $request->title,
        'status' => 1,
        'admin' => $auth,
    
    ]);

    return redirect()->route('admin.category.list')->with('success', 'Category created successfully.');
}

public function categoryEdit($id)
{
    $category = Category::findOrFail($id);
    return view('adminmodule::admin.category.edit', compact('category'));
}

public function categoryUpdate(Request $request, $id)
{
    $category = Category::findOrFail($id);

    $request->validate([
        'title' => 'required|string',
       
    ]);

    $category->update([
        'title' => $request->title,
       
    ]);

    return redirect()->route('admin.category.list')->with('success', 'Category updated successfully.');
}

public function categoryDestroy($id)
{
    $category = Category::findOrFail($id);
    $category->delete();

    return redirect()->route('admin.category.list')->with('success', 'Category deleted.');
}

public function categoryShow($id)
{
    $category = Category::findOrFail($id);
    return view('adminmodule::admin.category.show', compact('category'));
}

 public function categoryPublishStatus($id)
    {
        $category = Category::findOrFail($id);
        $category->status = !$category->status;
        $category->save();

        return response()->json([
            'success' => true,
            'status' => $category->status
        ]);
    }

}
