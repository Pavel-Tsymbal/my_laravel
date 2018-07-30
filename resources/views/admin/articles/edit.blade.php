@extends('layouts.admin')
@section('content')
    <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
        <h1>Редактировать статью</h1>
        <br>
        <form method="post">
            {!! csrf_field() !!}
            <p>Название статьи: <br><input type="text" name="title" class="form-control" value="{{ $article->title }}" required> </p>
            <p>Автор статьи: <br><input type="text" name="author" class="form-control" value="{{ $article->author }}" required> </p>
            <p>Описание статьи: <br><textarea name="short_text" class="form-control" required>{!! $article->short_text !!}</textarea></p>
            <p>Текст статьи: <br><textarea name="full_text" class="form-control" required>{!! $article->full_text !!}</textarea></p>
            <br><button type="submit" class="btn btn-success" style="float: right; cursor: pointer">Сохранить изменения</button>
        </form>
    </main>
@stop