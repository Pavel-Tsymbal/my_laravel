@extends('layouts.blog')
@section('content')

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('/blog/img/post-bg.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1>{!! $article->title !!}</h1>
                        <h2 class="subheading">{!! $article->short_text !!}</h2>
                        <span class="meta">Posted by
                <a href="#">{!! $article->author !!}</a>
                            {!! $article->created_at->format('m.d.Y H:i') !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <p>{!! $article->full_text !!}</p>
                </div>
            </div>
            @if (Auth::user())
                <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
                    <form class="form-horizontal" method="post" action="{{route('comment.add')}}">
                        {!! csrf_field() !!}
                        <input style="display: none" name="user_id" value="{{Auth::user()->id}}">
                        <input style="display: none" name="user_name" value="{{Auth::user()->name}}">
                        <input style="display: none" name="article_id" value="{{$article->id}}">

                        <div class="form-group">
                            <label for="comment">Ваш комментарий:</label><br>
                            <textarea name="comment" class="form-control" required></textarea><br>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Добавить комментарий" class="btn btn-success" style="float: right;">
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </article>



@stop