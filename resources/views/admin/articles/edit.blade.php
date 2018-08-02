@extends('layouts.admin')
@section('content')
    <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
        <h1>Редактировать статью</h1>
        <br>
        <form method="post">
            {!! csrf_field() !!}
            <p>Выбор категорий: <br> <select name="categories[]" class="form-control" multiple>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" @if (in_array($category->id,$idCategories)) selected @endif>{{$category->title}}</option>
                    @endforeach

                </select></p>
            <p>Название статьи: <br><input type="text" name="title" class="form-control" value="{{ $article->title }}" required> </p>
            <p>Автор статьи: <br><input type="text" name="author" class="form-control" value="{{ $article->author }}" required> </p>
            <p>Автор e-mail: <br><input type="text" name="author_email" class="form-control" value="{{ $article->author_email }}" required> </p>
            <p>Описание статьи: <br><textarea name="short_text" class="form-control" required>{!! $article->short_text !!}</textarea></p>
            <p>Текст статьи: <br><textarea name="full_text" class="form-control" required>{!! $article->full_text !!}</textarea></p>
            <br><button type="submit" class="btn btn-success" style="float: right; cursor: pointer">Сохранить изменения</button>
        </form>
    </main>
@stop