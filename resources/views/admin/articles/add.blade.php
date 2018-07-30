@extends('layouts.admin')
@section('content')
    <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
        <h1>Написать статью</h1>
        <br>
        <form method="post">
            {!! csrf_field() !!}
            <p>Выбор категорий: <br> <select name="categories[]" class="form-control" multiple>
                    @foreach($categories as $category)
                        <?php $count++ ?>
                        <option value="{{$count}}">{{$category->title}}</option>
                    @endforeach

                </select></p>
            <p>Введите название статьи: <br><input type="text" name="title" class="form-control" required></p>
            <p>Автор статьи: <br><input type="text" name="author" class="form-control" required></p>
            <p>Описание статьи:<br><textarea name="short_text" class="form-control" required></textarea></p>
            <p>Текст статьи:<br><textarea name="full_text" class="form-control" required></textarea></p>
            <br>
            <button type="submit" class="btn btn-success" style="float: right; cursor: pointer">Добавить статью</button>
        </form>
    </main>
@stop