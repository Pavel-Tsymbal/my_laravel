@extends('layouts.admin')
@section('content')
    <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
        <h1>Статьи</h1>
        <br>
        <a href="{{ route('articles.add') }}" class="btn btn-info" style="cursor: pointer">Написать статью</a>
        <br><br><br>
        <table class="table table-bordered">
            <tr>
                <td><b>#</b></td>
                <td><b>Название</b></td>
                <td><b>Описание</b></td>
                <td><b>Текст статьи</b></td>
                <td><b>Автор</b></td>
                <td><b>Дата написания</b></td>
                <td><b>Действия</b></td>
            </tr>
            @foreach($articles as $article)
                <?php $count++?>
                <tr>
                    <td>{{$count}}</td>
                    <td>{{$article->title}}</td>
                    <td>{{ $article->short_text }}</td>
                    <td>{!! $article->full_text !!}</td>
                    <td>{{ $article->author }}</td>
                    <td>{{$article->created_at->format('d.m.Y h:m')}}</td>
                    <td><a href="{{route('articles.edit',['id'=>$article->id])}}">Изменить</a> ||
                        <a href="{{route('articles.delete',['id'=>$article->id])}}"
                           onclick="return window.confirm('Вы уверены что хотите удалить эту статью?')">Удалить</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </main>
@stop