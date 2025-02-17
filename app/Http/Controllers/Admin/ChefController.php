<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ChefDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChefCreateRequest;
use App\Http\Requests\Admin\ChefUpdateRequest;
use App\Models\Chef;
use App\Models\SectionTitle;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class ChefController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ChefDataTable $dataTable)
    {
        $keys = ['chef_top_title', 'chef_main_title', 'chef_sub_title'];
        $titles = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        return $dataTable->render('admin.chef.index', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.chef.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChefCreateRequest $request)
    {
        $imagePath = $this->uploadImage($request, 'image', '/uploads/chefs');

        $chef = new Chef();
        $chef->image = $imagePath;
        $chef->name = $request->name;
        $chef->title = $request->title;
        $chef->fb = $request->fb;
        $chef->in = $request->in;
        $chef->x = $request->x;
        $chef->web = $request->web;
        $chef->show_at_home = $request->show_at_home;
        $chef->status = $request->status;
        $chef->save();

        toastr()->success('Created Successfully!');

        return to_route('admin.chefs.index')->with('status', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $chef = Chef::findOrFail($id);
        return view('admin.chef.edit', compact('chef'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChefUpdateRequest $request, string $id)
    {
        $imagePath = $this->uploadImage($request, 'image', '/uploads/chefs', $request->old_image);

        $chef = Chef::findOrFail($id);
        $chef->image = !empty($imagePath) ? $imagePath : $request->old_image;
        $chef->name = $request->name;
        $chef->title = $request->title;
        $chef->fb = $request->fb;
        $chef->in = $request->in;
        $chef->x = $request->x;
        $chef->web = $request->web;
        $chef->show_at_home = $request->show_at_home;
        $chef->status = $request->status;
        $chef->save();

        toastr()->success('Update Successfully!');

        return to_route('admin.chefs.index')->with('status', 'success');
    }

    public function updateTitle(Request $request)
    {
        $validatedData = $request->validate([
            'chef_top_title' => ['max:100'],
            'chef_main_title' => ['max:200'],
            'chef_sub_title' => ['max:500']
        ]);

        foreach ($validatedData as $key => $value) {
            SectionTitle::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        toastr()->success('Updated Successfully!');

        return redirect()->back()->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $chef = Chef::findOrFail($id);
            $this->removeImage($chef->image);
            $chef->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }
    }
}
