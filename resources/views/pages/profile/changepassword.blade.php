@extends('layout.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 grid-margin stretch-card ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    @php
                        $id = auth()->user()->id;
                    @endphp

                    <form class="forms-sample" method="POST" action="{{ url('/update-password/' . $id) }}" autocomplete="off">
                        @csrf
                        <div class="form-group">

                            <label for="old-password">Password</label>
                            <input type="password" class="form-control" id="old-password" placeholder="old password"
                                name="old_password">
                            @error('old_password')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">

                            <label for="passowrd">New Password</label>
                            <input type="password" class="form-control" id="password" placeholder="new password"
                                name="password">
                            @error('password')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Confirm Password</label>
                            <input type="password" id="password_confirmation" required="required" class="form-control"
                                name="password_confirmation" autocomplete="off" autofocus>


                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ url('/profile/' . auth()->user()->id) }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
