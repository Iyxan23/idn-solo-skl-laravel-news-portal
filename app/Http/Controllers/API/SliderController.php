<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function getAllSliders()
    {
        $sliders = Slider::all();
        return ResponseFormatter::success($sliders, 'Successfully listed all sliders');
    }

    public function create(Request $request)
    {
        try {
            $this->validate($request, [
                'image' => 'required|mimes:png,jpg,jpeg',
                'url' => 'required|string',
                'title' => 'required|string',
                'description' => 'required_if:anotherfield,value'
            ]);

            $image = $request->file('image');
            $image->storeAs('public/categories', $image->hashName());

            $slider = Slider::create([
                'image' => $image->hashName(),
                'url' => $request->url,
                'title' => $request->title,
                'description' => $request->description,
            ]);

            if ($slider) {
                return ResponseFormatter::success($slider, 'Slider successfully added');
            } else {
                return ResponseFormatter::error(null, 'Failed to create slider', 500);
            }

        } catch (\Error $err) {
            return ResponseFormatter::error($err, 'Failed to create slider', 500);
        }
    }
}