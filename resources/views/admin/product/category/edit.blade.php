@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Update Category</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.category.update',  $category->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                    </div>


                    <!-- Show_At_Home -->
                    <div class="form-group">
                        <label>Show At Home</label>
                        <select name="show_at_home" id="" class="form-control">
                            <option @selected($category->show_at_home === 1) value="1">Yes</option>
                            <option @selected($category->show_at_home === 0)value="0">No</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="" class="form-control">
                            <option @selected($category->status === 1) value="1">Active</option>
                            <option @selected($category->status === 0) value="0">InActive</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
@endsection
