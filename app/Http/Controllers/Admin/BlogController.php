<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogCommentDataTable;
use App\DataTables\BlogDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogCreateRequest;
use App\Http\Requests\Admin\BlogUpdateRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Str;

class BlogController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(BlogDataTable $dataTable)
    {
        return $dataTable->render('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::all();
        return view('admin.blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCreateRequest $request)
    {
        $imagePath = $this->uploadImage($request, 'image' , "/uploads/blog");

        $blog = new Blog();
        $blog->user_id = auth()->user()->id;
        $blog->image = $imagePath;
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->category_id = $request->category;
        $blog->description = $request->description;
        $blog->seo_title = $request->seo_title;
        $blog->seo_description = $request->seo_description;
        $blog->status = $request->status;
        $blog->save();

        toastr()->success('Created Successfully');

        return to_route('admin.blogs.index')->with('status'  , 'success');


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::all();
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogUpdateRequest $request, string $id)
    {
        $imagePath = $this->uploadImage($request, 'image', "/uploads/blog" , $request->old_image);

        $blog = Blog::findOrFail($id);
        $blog->image = !empty($imagePath) ? $imagePath : $request->old_image;
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->category_id = $request->category;
        $blog->description = $request->description;
        $blog->seo_title = $request->seo_title;
        $blog->seo_description = $request->seo_description;
        $blog->status = $request->status;
        $blog->save();

        toastr()->success('Created Successfully');

        return to_route('admin.blogs.index')->with('status'  , 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $this->removeImage($blog->image);
            $blog->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }
    }

    function blogComment(BlogCommentDataTable $dataTable)
    {
        return $dataTable->render('admin.blog.blog-comment.index');
    }

    function commentStatusUpdate(string $id) {
        $comment = BlogComment::find($id);

        $comment->status = !$comment->status;
        $comment->save();

        toastr()->success('Updated Successfully');
        return redirect()->back()->with('status'  ,'success');
    }

    function commentDestroy(string $id)  {
        try {
            $comment = BlogComment::findOrFail($id);
            $comment->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }
    }
}
