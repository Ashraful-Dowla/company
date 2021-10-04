@extends('admin.admin-master')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8 mx-3">
            <div class="card">
                @if(session('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card-header">Edit Brand</div>
                <div class="card-body">
                    <form action="{{ url('brand/update/'.$brand->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="old_image" value="{{ $brand->brand_image}}">
                        <div class="form-group">
                            <label for="brandName">Brand Name</label>
                            <input type="text" name="brand_name" class="form-control" id="brandName"
                                placeholder="Enter brand name" value="{{ $brand->brand_name}}">
                            @error('brand_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="brandNImage">Brand Image</label>
                            <input type="file" name="brand_image" class="form-control" id="brandNImage" />
                            @error('brand_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <img src="{{ asset($brand->brand_image)}}" alt="" width="400" height="200">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Brand</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection