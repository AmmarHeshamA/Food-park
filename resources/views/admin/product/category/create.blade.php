@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Create Category</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>


                    <!-- Show_At_Home -->
                    <div class="form-group">
                        <label>Show At Home</label>
                        <select name="show_at_home" id="" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">InActive</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">InActive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </section>
@endsection
