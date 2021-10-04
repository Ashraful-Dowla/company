@extends('admin.admin-master')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-10">
            <div class="card card-default">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card-header card-header-border-bottom">
                    <h2>Update Profile</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.profile.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            @if($user->profile_photo_path)
                            <input type="hidden" name="old_image" value="{{ $user->profile_photo_path }}">
                            <img src="{{ asset('storage/'.$user->profile_photo_path) }}" alt="profile photo"
                                class="rounded-circle" width="200" height="200">
                            @else
                            <img src="{{ asset('images/profile-pic-demo.png') }}" alt="profile photo"
                                class="rounded-circle" width="200" height="200">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name"
                                value="{{ $user->name}}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email"
                                value="{{ $user->email}}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="profile_photo_path">Profile Image</label>
                            <input type="file" name="profile_photo_path" class="form-control" />
                            @error('profile_photo_path')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-footer pt-4 pt-5 mt-4 border-top">
                            <button type="submit" class="btn btn-primary btn-default">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection