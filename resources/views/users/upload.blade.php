@extends('layouts.app')
@section('content')
    {{csrf_field()}}
    <img src="">
    <form class="form-control-file" action="{{route('upload')}}" enctype="multipart/form-data">
        <input type="file">
        <button type="submit">загрузить</button>
    </form>
@stop