<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCreateRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Traits\FileUploadTrait;
use Exception;

class ProductController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render("admin.product.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request)
    {
        $imagePath = $this->uploadImage($request, 'image', '/uploads/products');

        $name = $request->name;

        $product = new Product();
        $product->thumb_image = $imagePath;
        $product->name = $name;
        $product->slug = generateUniqueSlug('Product', $request->name);
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price ?? 0;
        $product->quantity = $request->quantity;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->sku = $request->sku;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->show_at_home = $request->show_at_home;
        $product->status = $request->status;
        $product->save();


        toastr()->success('Create Successfully');

        return to_route('admin.product.index')->with('status', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.product.edit', compact("product", "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $imagePath = $this->uploadImage($request, 'image', '/uploads/products', $product->thumb_image);

        $name = $request->name;

        $product->thumb_image = !empty($imagePath) ? $imagePath : $product->thumb_image;
        $product->name = $name;
        // $product->slug = generateUniqueSlug('Product', $request->name);
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price ?? 0;
        $product->quantity = $request->quantity;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->sku = $request->sku;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->show_at_home = $request->show_at_home;
        $product->status = $request->status;
        $product->save();


        toastr()->success('Updated Successfully');

        return to_route('admin.product.index')->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $this->removeImage($product->thumb_image);
            $product->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
