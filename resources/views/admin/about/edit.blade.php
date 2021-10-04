@extends('admin.admin-master')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-10">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Edit About</h2>
                </div>
                <div class="card-body">
                    <form action="{{ url('/about/update/'.$about->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter title" value="{{ $about->title}}">
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Short Description</label>
                            <textarea class="form-control" name="short_description" id="exampleFormControlTextarea1"
                                rows="2">{{  $about->short_description }}</textarea>
                            @error('short_description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Long Description</label>
                            <textarea class="form-control" name="long_description" id="exampleFormControlTextarea1"
                                rows="2">{{  $about->long_description }}</textarea>
                            @error('long_description')
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