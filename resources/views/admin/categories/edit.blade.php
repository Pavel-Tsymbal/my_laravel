@extends('layouts.admin')
@section('content')
    <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
        <h1>Изменить категорию</h1>
        <br>
        <form method="post">
            {!! csrf_field() !!}
            <p>Название категории: <br><input type="text" name="title" class="form-control" value="{{ $category->title }}" required> </p>
            <p>Описание категории:<br><textarea name="description" class="form-control">{!! $category->description !!}</textarea></p>
            <br><button type="submit" class="btn btn-success" style="float: right; cursor: pointer">Изменить</button>
        </form>
    </main>
@stop