<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function getAllSliders()
    {
        $sliders = Slider::all();
        return ResponseFormatter::success($sliders, 'Successfully listed all sliders');
    }

    public function getSliderById(int $id)
    {
        $slider = Slider::find($id);
        if ($slider) {
            return ResponseFormatter::success($slider, 'Successfully listed all sliders');
        } else {
            return ResponseFormatter::error(null, 'No slider with the specified id found', 404);
        }
    }

    public function create(Request $request)
    {
        try {
            $this->validate($request, [
                'image' => 'required|mimes:png,jpg,jpeg',
                'url' => 'required|string',
                'title' => 'required|string',
                'description' => 'required|string'
            ]);

            $image = $request->file('image');
            $image->storeAs('public/sliders', $image->hashName());

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

    public function delete(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required|exists:sliders,id'
            ]);

            $slider = Slider::find($request->id);
            Storage::disk('local')->delete('public/sliders/' . basename($slider->image));
            $slider->delete();

            if ($slider) {
                return ResponseFormatter::success($slider, "Successfully removed the slider");
            } else {
                return ResponseFormatter::error(null, "No slider found", 404);
            }
        } catch (\Error $err) {
            return ResponseFormatter::error($err, "Failed to delete the specified slider", 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required',
                'image' => 'mimes:png,jpg,jpeg',
                'url' => 'string',
                'title' => 'string',
                'description' => 'string'
            ]);

            $slider = Slider::find($request->id);
            if (!$slider) {
                return ResponseFormatter::error(null, "No slider with the given id found", 404);
            }

            $image = $request->file('image');
            if ($image) {
                // update the image
                Storage::disk('local')->delete('public/sliders/' . basename($image->hashName()));

                $image->storeAs('public/sliders', $image->hashName());
                $slider->update([
                    'image' => $image->hashName(),
                    'url' => $request->has('url') ? $request->url : $slider->url,
                    'title' => $request->has('title') ? $request->title : $slider->title,
                    'description' => $request->has('description') ? $request->description : $slider->description
                ]);
                $slider->save();

                if ($slider) {
                    return ResponseFormatter::success($slider, "Slider successfully updated");
                } else {
                    return ResponseFormatter::error(null, "Failed to update slider", 500);
                }
            } else {
                // update the values without the image
                $slider->update([
                    'url' => $request->has('url') ? $request->url : $slider->url,
                    'title' => $request->has('title') ? $request->title : $slider->title,
                    'description' => $request->has('description') ? $request->description : $slider->description
                ]);
                $slider->save();

                if ($slider) {
                    return ResponseFormatter::success($slider, "Slider successfully updated");
                } else {
                    return ResponseFormatter::error(null, "Failed to update slider", 500);
                }
            }

        } catch (\Error $err) {
            return ResponseFormatter::error($err, "Failed to update the given slider", 500);
        }
    }
}