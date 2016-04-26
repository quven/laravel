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
        {!! Form::textarea('into',null,['class'=>'form-control']) !!}
        {!! Form::hidden('publish_at',date("Y-m-d H:i:s",time()),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('发表文章',['class'=>'btn btn-success form-control']) !!}
    </div>
    {!! Form::close() !!}

        <ul>
    @foreach($validator->errors()->all() as $error)
        <li>{{$error}}</li>
    @endforeach
        </ul>



@stop