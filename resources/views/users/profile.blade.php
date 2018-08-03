@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <img src="/uploads/avatars/{{$user->avatar}}"
                     style="width: 150px; height: 150px; float: left; border-radius: 50%; margin-right: 25px;">
                <h2>{{$user->name}} profile! </h2>
                @if ($user->isAdmin)
                    <p>Администратор</p>
                @else
                    <p>Пользователь</p>
                @endif
            </div>
        </div>
    </div>
@endsection