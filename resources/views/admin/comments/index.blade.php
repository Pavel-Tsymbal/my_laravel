@extends('layouts.admin')
@section('content')
    <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
        <h1>Комментарии</h1>

        <br><br><br>
        <table class="table table-bordered">
            <tr>
                <td><b>#</b></td>
                <td><b>Ссылка на статью</b></td>
                <td><b>Имя пользователя</b></td>
                <td><b>Статуст</b></td>
                <td><b>Комментарий</b></td>
                <td><b>Когда оставлен</b></td>
                <td><b>Действия</b></td>
            </tr>
            @foreach($comments as $comment)
                <?php $count++?>
                <tr>
                    <td>{{$count}}</td>
                    <td>
                        <a href="{{route('blog.article',['id'=>$comment->article_id,'slug'=>\App\Entities\Article::find($comment->article_id)->title])}}">статья</a>
                    </td>
                    <td>
                        <form id="profile-form" action="{{route('profile.show',['name'=>$comment->user_name])}}"
                              method="POST">
                            @csrf
                            <input type="text" name="author_email"
                                   value="{{\App\Entities\User::find($comment->user_id)->email}}" style="display: none">
                            <input class="btn btn-link" type="submit" value="{{$comment->user_name}}"
                                   style="cursor: pointer">
                        </form>
                    </td>
                    <td>@if (!$comment->status) не опубликованно @else <b>опубликованно</b> @endif</td>
                    <td>{{$comment->comment}}</td>
                    <td>{{$comment->created_at->format('d.m.Y h:m')}}</td>
                    @if (!$comment->status)
                        <td><a href="{{route('comment.agree',['id'=>$comment->id])}}">Опубликовать</a> || <a href="{{route('comment.delete',['id'=>$comment->id])}}"
                                                                         onclick="return window.confirm('Вы уверены что хотите удалить этот комментарий?')">Удалить</a>
                        </td>
                    @else
                        <td><a href="{{route('comment.disagree',['id'=>$comment->id])}}">Снять с публикации</a> || <a href="{{route('comment.delete',['id'=>$comment->id])}}"
                                                                               onclick="return window.confirm('Вы уверены что хотите удалить этот комментарий?')">Удалить</a>
                        </td>
                    @endif


                </tr>
            @endforeach
        </table>
    </main>
@stop