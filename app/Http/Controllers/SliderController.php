<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSliderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSliderRequest $request)
    {
        // upload image
        $image = $request->file('image');
        $image->storeAs('/public/slider/', $image->hashName());

        Slider::create([
            'url' => $request->url,
            'image' => $image->hashName(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('slider.index')->with([
            Alert::success('Success', "Slider successfully added")
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        return view('admin.slider.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $this->validate($request, ['url' => 'url|string|required']);

        // check if the image changed
        if ($request->file('image') == '') {
            // update data without the image
            $slider = Slider::findOrFail($slider->id);
            $slider->update([
                'url' => $request->url,
                'title' => $request->title,
                'description' => $request->description,
            ]);
        } else {
            // delete the previous image
            Storage::disk('local')->delete('public/slider/' . basename($slider->image));

            // upload the new image
            $image = $request->file('image');
            $image->storeAs('public/slider', $image->hashName());

            // update with the new image
            $slider = Slider::findOrFail($slider->id);
            $slider->update([
                'image' => $image->hashName(),
                'url' => $request->url,
                'title' => $request->title,
                'description' => $request->description,
            ]);
        }

        return redirect() ->route('slider.index')->with([
            Alert::success('Success', 'Update successful')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        Storage::disk('local')->delete('public/slider/' . basename($slider->image));
        $slider->delete();

        return redirect()->route('slider.index')->with([
            Alert::success("Success", "Successfully deleted the slider")
        ]);
    }
}
