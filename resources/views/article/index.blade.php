@extends('public/public')

@section('title')
我的测试界面
@stop
@section('content')
<p><a href="{{url('article/create')}}">添加文章</a></p>
    @foreach($articles as $list)
        <p><a href="{{action('ArticleController@show',$list->id)}}">{{$list->title}}</a></p>
        <p>{{url('article',$list->id)}}</p>
        <p>{{$list->publish_at}}</p>
        <p>{{$list->into}}</p>

        @if($list->tags)
        <ul>
        @foreach($list->tags as $tag)
        <li>{{$tag->name}}</li>
        @endforeach
        </ul>
        @endif
        <hr/>
    @endforeach
@stop