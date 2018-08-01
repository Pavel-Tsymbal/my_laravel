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
                    <td>{{$user->created_at->format('d.m.Y H:i')}}</td>
                    <td>
                        @if (!$user->isAdmin)
                         <a href="#" onclick="return window.confirm('Вы уверены что хотите заблокировать этого пользователя?')">Заблокировать</a> ||
                        @endif

                        <a href="#">Перейти в профиль</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </main>
@stop