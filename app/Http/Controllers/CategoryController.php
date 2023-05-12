<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        // upload image
        $image = $request->file('image');
        $image->storeAs('/public/categories/', $image->hashName());

        $name = $request->name;

        Category::create([
            'name' => $name,
            'slug' => Str::slug($request->name, '-'),
            'image' => $image->hashName()
        ]);

        return redirect()->route('category.index')->with([
            Alert::success('Success', "Category $name successfully added")
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
             'name' => 'required|unique:categories,name,' . $category->id
        ]);

        // check if the image changed
        if ($request->file('image') == '') {
            // update data without the image
            $category = Category::findOrFail($category->id);
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
            ]);
        } else {
            // delete the previous image
            Storage::disk('local')->delete('public/categories/' . basename($category->image));

            // upload the new image
            $image = $request->file('image');
            $image->storeAs('public/categories', $image->hashName());

            // update with the new image
            $category = Category::findOrFail($category->id);
            $category->update([
                'image' => $image->hashName(),
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
            ]);
        }

        return redirect() ->route('category.index')->with([
            Alert::success('Success', 'Update successful')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $name = $category->name;
        Storage::disk('local')->delete('public/categories/' . basename($category->image));
        $category->delete();

        return redirect()->route('category.index')->with([
            Alert::success("Success", "Successfully deleted $name")
        ]);
    }

    public function searchCategory(Request $request)
    {
        $keyword = $request->keyword;
        $categories = Category::where('name', 'like', '%' . $keyword . '%')->paginate(5);

        return view('admin.category.index', compact('categories', 'keyword'));
    }
}