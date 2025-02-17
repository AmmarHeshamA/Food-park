<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class ProductGalleryController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(string $productId)
    {
        $product = Product::findOrFail($productId);
        $images = ProductGallery::where('product_id', $product->id)->get();
        return view('admin.product.gallery.index' , compact('product','images'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'product_id' => ['required', 'integer']
        ]);

        $imagePath = $this->uploadImage($request, 'image');

        $gallery = new ProductGallery();
        $gallery->product_id = $request->product_id;
        $gallery->image = $imagePath;
        $gallery->save();

        toastr()->success('Created Successfully!');

        return redirect()->back()->with('status' , 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $image = ProductGallery::findOrFail($id);
            $this->removeImage($image->image);
            $image->delete();

            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        }catch(\Exception $e){
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }
    }
}
