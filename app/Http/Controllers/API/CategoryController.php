<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseFormatSame;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
        try {
            $categories = Category::latest()->paginate(10);
            return ResponseFormatter::success($categories, "Categories successfully listed");
        } catch (\Error $err) {
            return ResponseFormatter::error(
                $err,
                "Failed to fetch categories",
                500
            );
        }
    }

    public function getCategoryById(int $id)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return ResponseFormatter::error(null, 'No such category exists', 404);
            }
            return ResponseFormatter::success($category, "Successfully fetched category");
        } catch (\Error $err) {
            return ResponseFormatter::error(
                $err,
                "Failed to fetch category",
                500
            );
        }
    }

    public function create(Request $request)
    {
        try {
            // make sure the request parameters are set
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'image' => 'required|mimes:png,jpg,jpeg',
            ]);

            // upload the image as usual
            $image = $request->file('image');
            $image->storeAs('public/categories', $image->hashName());

            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'image' => $image->hashName(),
            ]);

            if ($category) {
                return ResponseFormatter::success($category, 'Category successfully added');
            } else {
                return ResponseFormatter::error(null, 'Failed to create category', 500);
            }

        } catch (\Error $err) {
            return ResponseFormatter::error($err, "Failed to create category", 500);
        }
    }
}