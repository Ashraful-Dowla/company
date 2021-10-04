@extends('admin.admin-master')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if(session('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card-header">
                    All Slider
                    <a href="{{ route('add.slider') }}" class="btn btn-info float-right">Add</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SL No.</th>
                                <th scope="col">Slider Title</th>
                                <th scope="col">Slider Description</th>
                                <th scope="col">Slider Image</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @forelse ($sliders as $slider)
                            <tr>
                                <td scope="row">{{ $i++ }}</td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->description }}</td>
                                <td> <img src="{{ asset($slider->image)}}" alt="" width="70" height="40"></td>
                                <td>{{ $slider->created_at->diffForHumans()}}</td>
                                <td><a href="{{ url('slider/edit/'.$slider->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('slider/delete/'. $slider->id)}}"
                                        onclick="return confirm('Are you sure you want to delete?')"
                                        class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>No data found</td>
                            <tr>
                                @endforelse
                        </tbody>
                    </table>
                    {{ $sliders->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection