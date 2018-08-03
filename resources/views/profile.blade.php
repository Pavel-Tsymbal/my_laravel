@extends('layouts.app')

@section('content')
    <br><br><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <img src="/uploads/avatars/{{$user->avatar}}"
                     style="width: 150px; height: 150px; float: left; border-radius: 50%; margin-right: 25px;">
                <h2>{{$user->name}} profile! </h2>
                <form enctype="multipart/form-data" method="post">
                    <label>Update Profile Image</label><br>
                    <input type="file" name="avatar">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="submit" class="pull-right btn btn-sm btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection