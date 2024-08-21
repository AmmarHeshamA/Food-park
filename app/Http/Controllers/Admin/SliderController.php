<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderCreateRequest;
use App\Http\Requests\Admin\SliderUpdateRequest;
use App\Models\Slider;
use App\Traits\FileUploadTrait;
use Exception;
use Illuminate\Contracts\View\View;

class SliderController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderCreateRequest $request)
    {
        // Handle Photo

        $slider = new Slider();
        $image = $this->uploadImage($request, 'image', '/uploads/slider');
        $slider->image = $image;
        $slider->title = $request->title;
        $slider->offer = $request->offer;
        $slider->sub_title = $request->sub_title;
        $slider->short_description = $request->short_description;
        $slider->button_link = $request->button_link;
        $slider->status = $request->status;
        $slider->save();

        toastr('Created Successfully', 'success');

        return to_route('admin.slider.index')->with('status', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider): View
    {
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderUpdateRequest $request, Slider $slider)
    {
        $image = $this->uploadImage($request, 'image', '/uploads/slider', $slider->image);

        $slider->image = !empty($image) ? $image : $slider->image;
        $slider->title = $request->title;
        $slider->offer = $request->offer;
        $slider->sub_title = $request->sub_title;
        $slider->short_description = $request->short_description;
        $slider->button_link = $request->button_link;
        $slider->status = $request->status;
        $slider->save();

        toastr('Updated Successfully', 'success');

        return to_route('admin.slider.index')->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        try {
            $slider->delete();
            $this->removeImage($slider->image);
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
