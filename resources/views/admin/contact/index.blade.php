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
                    All Contact
                    <a href="{{ route('add.contact') }}" class="btn btn-info float-right">Add</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SL No.</th>
                                <th scope="col">Address</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @forelse ($contacts as $contact)
                            <tr>
                                <td scope="row">{{ $i++ }}</td>
                                <td>{{ $contact->address }}</td>
                                <td>{{ $contact->email }}</td>
                                <td> {{ $contact->phone }}</td>
                                <td>{{ $contact->created_at->diffForHumans()}}</td>
                                <td><a href="{{ url('/admin/contact/edit/'.$contact->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('/admin/contact/delete/'. $contact->id)}}"
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
                    {{ $contacts->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection