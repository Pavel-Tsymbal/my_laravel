@extends('layouts.admin')
@section('content')
    <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
        <h1>Категории</h1>
        <br>
        <a href="{{ route('categories.add') }}" class="btn btn-info" style="cursor: pointer">Добавить
            категорию</a>
        <br><br><br>
        <table class="table table-bordered">
            <tr>
                <td><b>#</b></td>
                <td><b>Название категории</b></td>
                <td><b>Описание категории</b></td>
                <td><b>Дата добавления</b></td>
                <td><b>Действия</b></td>
            </tr>
            @foreach($categories as $category)
                <?php $count++?>
                <tr>
                    <td>{{$count}}</td>
                    <td>{{$category->title}}</td>
                    <td>{!! $category->description !!}</td>
                    <td>{{$category->created_at->format('d.m.Y h:m')}}</td>
                    <td><a href="{{route('categories.edit',['id'=>$category->id])}}">Изменить</a> ||
                        <a href="{{route('categories.delete',['id'=>$category->id])}}"
                           onclick="return window.confirm('Вы уверены что хотите удалить эту категорию?')">Удалить</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </main>
@stop
