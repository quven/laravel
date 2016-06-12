@extends('public/public')

@section('title')
    编辑界面
@stop
@section('content')
    {!! Form::model($article,['url'=>'article/update']) !!}
    <div class="form-group">
        {!! Form::label('title','标题:') !!}
        {!! Form::text('title',null,['class'=>'form-control']) !!}
        {!! Form::input('hidden','id',null) !!}
    </div>
    <div class="form-group">
        {!! Form::label('into','正文:') !!}
        <p> {!! Form::textarea('into',null,['class'=>'form-control']) !!}</p>
        <p> {!! Form::input('date','publish_at',substr($article->publish_at,0,10),['class'=>'form-control']) !!}</p>
        <p>
            @foreach($tags as $k=>$tag)
                {!! Form::label('into',$tag) !!}
                {!!Form::checkbox('tags[]',$k)!!}
            @endforeach
        </p>
    </div>
    <div class="form-group">
        {!! Form::submit('发表文章',['class'=>'btn btn-success form-control']) !!}
    </div>
    {!! Form::close() !!}
    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif



@stop