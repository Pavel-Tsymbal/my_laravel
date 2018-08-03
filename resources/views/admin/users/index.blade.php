@extends('layouts.admin')
@section('content')
    <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
        <h1>Пользователи</h1>

        <br><br><br>
        <table class="table table-bordered">
            <tr>
                <td><b>#</b></td>
                <td><b>Name</b></td>
                <td><b>Email</b></td>
                <td><b>Роль</b></td>
                <td><b>Состояние</b></td>
                <td><b>Дата регистрации</b></td>
                <td><b>Действия</b></td>
            </tr>
            @foreach($users as $user)
                <?php $count++?>
                <tr>
                    <td>{{$count}}</td>
                    <td>{{$user->name}}</td>
                    <td>{!! $user->email !!}</td>
                    <td> @if ($user->isAdmin) Администратор @else Пользователь @endif </td>
                    <td> @if ($user->isBanned) <b>Заблокирован</b> @else Свободен @endif </td>
                    <td>{{$user->created_at->format('d.m.Y H:i')}}</td>
                    <td>

                        <form id="profile-form" action="{{route('profile.show',['name'=>$user->name])}}"
                              method="POST">
                            @csrf
                            @if (!$user->isAdmin && !$user->isBanned)
                                <a href="{{route('user.ban',['id'=>$user->id])}}"
                                   onclick="return window.confirm('Вы уверены что хотите заблокировать пользователя  {{$user->name}} ?')">Заблокировать</a>
                                ||
                            @elseif (!$user->isAdmin && $user->isBanned)
                                <a href="{{route('user.unban',['id'=>$user->id])}}"
                                   onclick="return window.confirm('Вы уверены что хотите разблокировать пользователя {{$user->name}} ?')">Разблокировать</a>
                                ||
                            @endif
                            <input type="text" name="author_email" value="{{$user->email}}"
                                   style="display: none">
                            <input class="btn btn-link" type="submit" value="Перейти в профиль" style="cursor: pointer">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </main>
@stop