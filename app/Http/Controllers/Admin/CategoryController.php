<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render("admin.product.category.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.product.category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request): RedirectResponse
    {
        $name = $request->name;
        Category::create([
            "name" => $name,
            "slug" => Str::slug($name),
            'status' => $request->status,
            'show_at_home' => $request->show_at_home,
        ]);

        toastr()->success('Created Successfully!');

        return to_route('admin.category.index')->with('status', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.product.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $name = $request->name;
        $category->update([
            "name" => $name,
            "slug" => Str::slug($name),
            'status' => $request->status,
            'show_at_home' => $request->show_at_home,
        ]);

        toastr()->success('Created Successfully!');

        return to_route('admin.category.index')->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
