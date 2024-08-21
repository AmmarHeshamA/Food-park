<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductRatingDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductRating;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    function index(ProductRatingDataTable $dataTable) {
        return $dataTable->render('admin.product.product-review.index');
    }

    function updateStatus(Request $request)  {
        $review = ProductRating::findOrFail($request->id);
        $review->status = $request->status;
        $review->save();
        return response(['status' => 'success', 'message' => 'updated successfully!']);
    }

    function destroy(string $id)  {
        try {
            $review = ProductRating::findOrFail($id);
            $review->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }
    }
}
