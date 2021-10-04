@extends('admin.admin-master')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                {{-- @if(session('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif --}}
                <div class="card-header">
                    All Brand
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SL No.</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Brand Image</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach ($brands as $brand)
                            <tr>
                                <td scope="row">{{ $i++ }}</td>
                                <td>{{ $brand->brand_name }}</td>
                                <td> <img src="{{ asset($brand->brand_image)}}" alt="" width="70" height="40"></td>
                                <td>{{ $brand->created_at->diffForHumans()}}</td>
                                <td><a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('brand/delete/'. $brand->id)}}"
                                        onclick="return confirm('Are you sure you want to delete?')"
                                        class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $brands->links() }}
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Add Brand</div>
                <div class="card-body">
                    <form action="{{ route('store.brand') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="brandName">Brand Name</label>
                            <input type="text" name="brand_name" class="form-control" id="brandName"
                                placeholder="Enter brand name">
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
                        <button type="submit" class="btn btn-primary">Add Brand</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection