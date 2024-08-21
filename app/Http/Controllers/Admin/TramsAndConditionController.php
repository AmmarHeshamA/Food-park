<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TramsAndCondition;
use Illuminate\Http\Request;

class TramsAndConditionController extends Controller
{
    function index()
    {
        $tramsAndCondition = TramsAndCondition::first();
        return view('admin.trams-and-condition.index', compact('tramsAndCondition'));
    }

    function update(Request $request)
    {
        $request->validate([
            'content' => ['required']
        ]);

        TramsAndCondition::updateOrCreate(
            ['id' => 1],
            [
                'content' => $request->content
            ]
        );
        toastr()->success('Updated Successfully');

        return redirect()->back()->with('status' , 'success');
    }
}
