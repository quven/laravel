@extends('public/public')
@section('title')
详情界面
@stop
@section('content')
    title:{{$article->title}}<br/>
    into:{{$article->into}}
@stop