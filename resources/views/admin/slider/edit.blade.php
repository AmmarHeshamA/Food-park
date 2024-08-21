@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Create Slider</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.slider.update',  $slider->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- image -->
                    <div class="form-group">
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload">
                        </div>
                    </div>

                    <!-- Offer -->
                    <div class="form-group">
                        <label>Offer</label>
                        <input type="text" class="form-control" name="offer" value="{{ $slider->offer }}">
                    </div>

                    <!-- Title -->
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $slider->title }}">
                    </div>

                    <!-- Sub Title -->
                    <div class="form-group">
                        <label>Sub Title</label>
                        <input type="text" class="form-control" name="sub_title" value="{{ $slider->sub_title }}">
                    </div>

                    <!-- short_description -->
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="short_description">{{ $slider->short_description }}</textarea>
                    </div>

                    <!-- button_link -->
                    <div class="form-group">
                        <label>Button Links</label>
                        <input type="text" class="form-control" name="button_link"
                            value="{{ $slider->button_link }}">
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="" class="form-control">
                            <option @selected($slider->status == 1) value="1">Active</option>
                            <option @selected($slider->status == 0) value="0">InActive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.image-preview').css({
                'background-image': 'url({{ asset($slider->image) }})',
                'background-size': 'cover',
                'background-position': 'center center',
            })
        })
    </script>
@endpush
