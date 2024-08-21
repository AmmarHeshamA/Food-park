<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait FileUploadTrait
{
    public function uploadImage($request, $inputName, $path = "/uploads", $existingFilePath = null)
    {
        if ($request->hasFile($inputName)) {
            if ($existingFilePath && $existingFilePath !== '/uploads/avatar.jpg' && File::exists(public_path($existingFilePath))) {
                File::delete(public_path($existingFilePath));
            }

            $image = $request->file($inputName);
            $extension = $image->getClientOriginalExtension();
            $imageName = 'media_' . uniqid() . '.' . $extension;

            $image->move(public_path($path), $imageName);

            return $path . '/' . $imageName;
        }

        return null;
    }



    // Remove image
    public function removeImage(?string $path) // Use nullable type hint
{
    if ($path === null || $path === '/uploads/avatar.jpg' || !File::exists(public_path($path))) {
        return;
    }

    File::delete(public_path($path));
}

}
