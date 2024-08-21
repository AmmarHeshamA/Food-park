<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AppDownloadSectionCreateRequest;
use App\Models\AppDownloadSection;
use App\Traits\FileUploadTrait;


class AppDownloadSectionController extends Controller
{
    use FileUploadTrait;

    function index()
    {
        $appSection = AppDownloadSection::first();
        return view('admin.app-download-section.index', compact('appSection'));
    }

    function store(AppDownloadSectionCreateRequest $request)
    {
        $defaultAvatarPath = '/uploads/avatar.jpg';

        $imagePath = $this->uploadImage($request, 'image', '/uploads/app-Download', $request->old_image !== $defaultAvatarPath ? $request->old_image : null);
        $backgroundPath = $this->uploadImage($request, 'background', '/uploads/app-Download', $request->old_background !== $defaultAvatarPath ? $request->old_background : null);

        AppDownloadSection::updateOrCreate(
            ['id' => 1],
            [
                'image' => $imagePath ?? $request->old_image,
                'background' => $backgroundPath ?? $request->old_background,
                'title' => $request->title,
                'short_description' => $request->short_description,
                'play_store_link' => $request->play_store_link,
                'apple_store_link' => $request->apple_store_link,
            ]
        );

        toastr()->success('Updated Successfully!');

        return to_route('admin.app-download.index')->with('status', 'success');
    }
}
