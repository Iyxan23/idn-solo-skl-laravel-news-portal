<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::latest()->paginate(10);
        $category = Category::all();

        return view('admin.news.index', compact('news', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category'      => 'required',
            'title'         => 'required',
            'image'         => 'required|mimes:png,jpg,jpeg,webp',
            'description'   => 'required'
        ]);

        // upload image
        $image = $request->file('image');
        $image->storeAs('/public/news/', $image->hashName());

        $title = $request->title;

        News::create([
            'category_id' => $request->category,
            'title' => $title,
            'slug' => Str::slug($request->title, '-'),
            'image' => $image->hashName(),
            'description' => $request->description,
        ]);

        return redirect()->route('news.index')->with([
            Alert::success('Success', "$title successfully published")
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
        $category = Category::all();
        $news = News::find($id);

        return view('admin.news.show', compact('category', 'news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $news = News::findOrFail($id);

        return view('admin.news.edit', compact('categories', 'news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $this->validate($request, [
            'title' => 'required|unique:categories,title,' . $news->id,
            'image' => 'mimes:png,jpg,jpeg,webp,gif'
        ]);

        // check if the image changed
        if ($request->file('image') == '') {
            // update data without the image
            $news = News::findOrFail($news->id);
            $news->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'slug' => Str::slug($request->title, '-'),
                'description' => $request->description,
            ]);
        } else {
            // delete the previous image
            Storage::disk('local')->delete('public/news/' . basename($news->image));

            // upload the new image
            $image = $request->file('image');
            $image->storeAs('public/news', $image->hashName());

            // update with the new image
            $news = News::findOrFail($news->id);
            $news->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'slug' => Str::slug($request->title, '-'),
            ]);
        }

        if ($news) {
            return redirect()->route('news.index')->with([
                Alert::success("Success", "Updated the news $news->title")
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        Storage::disk('local')->delete('public/news/' . basename($news->image));
        $news->delete();

        return redirect()->route('news.index')->with([
            Alert::success("Success", "Successfully deleted $news->name")
        ]);
    }

    public function searchNews(Request $request) {
        $keyword = $request->keyword;
        $news = News::where('title', 'like', '%' . $keyword . '%')->paginate(10);

        return view('admin.news.index', compact('news', 'keyword'));
    }
}
