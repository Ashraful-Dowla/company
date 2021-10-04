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
                    All About
                    <a href="{{ route('add.about') }}" class="btn btn-info float-right">Add</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SL No.</th>
                                <th scope="col">Title</th>
                                <th scope="col">Shorter Description</th>
                                <th scope="col">Longer Description</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @forelse ($about as $abt)
                            <tr>
                                <td scope="row">{{ $i++ }}</td>
                                <td>{{ $abt->title }}</td>
                                <td>{{ $abt->short_description }}</td>
                                <td> {{ $abt->long_description }}</td>
                                <td>{{ $abt->created_at->diffForHumans()}}</td>
                                <td><a href="{{ url('about/edit/'.$abt->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('about/delete/'. $abt->id)}}"
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
                    {{ $about->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection