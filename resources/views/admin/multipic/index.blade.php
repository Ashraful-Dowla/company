@extends('admin.admin-master')
@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            @if(session('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{session('success')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="col-md-8">
                <div class="card-group">
                    @foreach ($images as $item)
                    <div class="col-md-5 mt-5">
                        <div class="card">
                            <img src="{{ $item->image}}" alt="">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Multi Image</div>
                    <div class="card-body">
                        <form action="{{ route('store.image') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="image">Brand Image</label>
                                <input type="file" name="images[]" class="form-control" id="image" multiple="" />
                                @error('images')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Image</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection