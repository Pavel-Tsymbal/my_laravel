@extends('layouts.admin')
@section('content')
    <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
        <h1>Добавить категорию</h1>
        <br>
        <form method="post">
            {!! csrf_field() !!}
        <p>Введите название категории: <br><input type="text" name="title" class="form-control" required> </p>
        <p>Описание категории:<br><textarea name="description" class="form-control"></textarea></p>
        <br><button type="submit" class="btn btn-success" style="float: right; cursor: pointer">Добавить</button>
        </form>
    </main>
@stop