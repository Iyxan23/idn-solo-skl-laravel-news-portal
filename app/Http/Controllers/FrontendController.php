<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $news = News::latest()->get();
        $nav_category = Category::all();
        $side_news = News::inRandomOrder()->limit(5)->get();
        $slider = Slider::latest()->get();
        $title = "IDNesianNews - Homepage";
        
        // return view('welcome', compact('category', 'news'));
        // return view('frontend.index', compact('category', 'news'));
        return view('frontend.index', compact('nav_category', 'news', 'side_news', 'slider', 'title'));
    }

    public function detailCategory($slug) {
        $the_category = Category::where('slug', $slug)->first();

        $news = News::where('category_id', $the_category->id)->paginate(10);
        $side_news = News::inRandomOrder()->limit(5)->get();
        $title = "Category - $the_category->title";
        $category = Category::all();
        $nav_category = $category;

        return view('frontend.category-detail', compact('news', 'the_category', 'category', 'nav_category', 'side_news', 'title'));
    }

    public function detailNews($slug) {
        $news = News::where('slug', $slug)->first();
        $side_news = News::inRandomOrder()->limit(5)->get();
        $category = Category::all();
        $nav_category = $category;
        $title = "News - $news->title";

        return view('frontend.news-detail', compact('news', 'category', 'nav_category', 'side_news', 'title'));
    }

    public function searchNewsEnd(Request $request) {
        $keyword = $request->keyword;
        $news = News::where('title', 'like', '%' . $keyword . '%')->paginate(10);
        $nav_category = Category::all();
        $side_news = News::inRandomOrder()->limit(5)->get();
        $slider = Slider::latest()->get();
        $title = "IDNesianNews - Homepage";

        // return view('frontend.index', compact('news'));
        return view('frontend.index', compact('nav_category', 'news', 'side_news', 'slider', 'title'));
    }
}
