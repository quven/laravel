@extends('public/public')

@section('title')
     添加界面
@stop
@section('content')
    {!! Form::open(['url'=>'article/store']) !!}
    <div class="form-group">
        {!! Form::label('title','标题:') !!}
        {!! Form::text('title',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('into','正文:') !!}
       <p> {!! Form::textarea('into',null,['class'=>'form-control']) !!}</p>
        <p> {!! Form::input('date','publish_at',date('Y-m-d'),['class'=>'form-control']) !!}</p>
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





@stop