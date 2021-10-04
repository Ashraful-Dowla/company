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
                    All Contact Message
                    <a href="{{ route('add.contact') }}" class="btn btn-info float-right">Add</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" width="10%">SL No.</th>
                                <th scope="col" width="10%">Name</th>
                                <th scope="col" width="10%">Email</th>
                                <th scope="col" width="15%">Subject</th>
                                <th scope="col" width="40%">Message</th>
                                <th scope="col" width="5%">Created At</th>
                                <th scope="col" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @forelse ($messages as $message)
                            <tr>
                                <td scope="row">{{ $i++ }}</td>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td> {{ $message->subject }}</td>
                                <td> {{ $message->message }}</td>
                                <td>{{ $message->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{ url('/admin/contact/message/delete/'. $message->id)}}"
                                        onclick="return confirm('Are you sure you want to delete?')"
                                        class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td >No data found</td>
                            <tr>
                                @endforelse
                        </tbody>
                    </table>
                    {{ $messages->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection