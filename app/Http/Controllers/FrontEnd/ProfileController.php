<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\ProfilePasswordUpdateRequest as FrontEndProfilePasswordUpdateRequest;
use App\Http\Requests\FrontEnd\ProfileUpdateRequest;
use App\Traits\FileUploadTrait;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    use FileUploadTrait;
    function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr()->success("Personal Information Updated Successfully");

        return redirect()->back();
    }
    function updatePasswordProfile(FrontEndProfilePasswordUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        toastr()->success("Password Updated Successfully");

        return redirect()->back();
    }

    function updateAvatar(Request $request)
    {

        $user = Auth::user();
        $imagePath = $this->uploadImage($request, 'avatar' ,'/uploads/avatar' , $user->avatar);
        $user->avatar = $imagePath;
        $user->save();

        toastr()->success("Avatar Updated Successfully");

        return response(['status' => 'success', 'message' => 'Avatar Updated Successfully']);

    }
}
