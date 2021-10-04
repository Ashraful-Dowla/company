@extends('admin.admin-master')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-10">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Create Contact</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('store.contact')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Contact Email</label>
                            <input type="text" name="email" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter email address">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Contact Phone no.</label>
                            <input type="text" name="phone" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter phone number">
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Contact Address</label>
                            <textarea class="form-control" name="address" id="exampleFormControlTextarea1"
                                rows="2"></textarea>
                            @error('address')
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