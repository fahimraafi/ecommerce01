<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use PhpParser\Node\Expr\Cast\String_;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("layouts.dashboard.category.index", [
            'categories' => Category::all(),
            'products' => Product::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "category_name" => 'required',
            "category_slug" => 'required',
            "category_photo" => 'required|image',
        ]);

        // Category Image start
        $category_photo_name = $request->category_name . "_" . date('Y-m-d') . "." . $request->file('category_photo')->getClientOriginalExtension();

        $img = Image::make($request->file('category_photo'))->resize(200, 200);
        $img->save(base_path('public/uploads/category_photo/' . $category_photo_name), 80);
        // Category Image end

        $category_slug = Str::slug($request->category_slug);

        Category::insert([
            "category_name" => $request->category_name,
            "category_slug" => $category_slug,
            "category_photo" => $category_photo_name,
            "created_at" => Carbon::now(),
        ]);
        // return back()->with('category_added', 'Category added successfully');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('layouts.dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request;
        // $request->validate([
        //     'category_name' => 'required',
        // ]);

        Category::find($id)->update([
            "category_name" => $request->category_name,
            "category_slug" => Str::slug($request->category_slug),
        ]);

        if ($request->hasFile('category_photo')) {
            unlink(base_path('public/uploads/category_photo/' . Category::find($id)->category_photo) );

            $category_photo_name = $request->category_name . "_" . date('Y-m-d') . "." . $request->file('category_photo')->getClientOriginalExtension();

            $img = Image::make($request->file('category_photo'))->resize(200, 200);
            $img->save(base_path('public/uploads/category_photo/' . $category_photo_name), 80);

            Category::find($id)->update([
                "category_photo" => $category_photo_name,
            ]);
        }
        return redirect()->route('category.index');
    }
    // public function slug_change(Request $request, string $id)
    // {
    //     return $id;
    //     // $request->validate([
    //     //     'category_slug' => 'required',
    //     // ]);

    //     // Category::find($id)->update([
    //     //     "category_slug" => $request->category_slug,

    //     // ]);
    //     // return back()->with('category_slug_updated', 'Category Slug Updated Successfully');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::find($category->id)->delete();
        return back();
    }
}
