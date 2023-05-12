<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        try {
            $news = News::latest()->paginate(10);

            return ResponseFormatter::success($news, "Successfully listed all news");
        } catch (\Error $err) {
            return ResponseFormatter::error($err, "Failed to retrieve news", 500);
        }
    }

    public function show(int $id)
    {
        try {
            $news = News::find($id);

            if ($news) {
                return ResponseFormatter::success($news, "News successfully retrieved");
            } else {
                return ResponseFormatter::error(null, "No such news exists", 404);
            }
        } catch (\Error $err) {
            return ResponseFormatter::error($err, "Failed to retrieve news", 500);
        }
    }
}