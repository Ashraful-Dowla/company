@extends('admin.admin-master')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-10">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Create Slider</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('store.slider')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter title">
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                rows="2"></textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Image</label>
                            <input type="file" name="image" class="form-control" id="exampleFormControlFile1">
                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-footer pt-4 pt-5 mt-4 border-top">
                            <button type="submit" class="btn btn-primary btn-default">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection