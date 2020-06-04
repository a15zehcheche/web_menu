@extends('layouts.app')
@section('content')
    <h1>Create Food</h1>
    {!! Form::open(['action' => 'FoodsController@store','method'=>'POST']) !!}
        <div class="form-group">
            {{Form::label('name','Food Name')}}
            {{Form::text('name','',['class'=>'form-control','placeholder'=>'Name'])}}
        </div>

        <div class="form-group">
            {{Form::label('price','Price')}}
            {{Form::number('price','',['class'=>'form-control','placeholder'=>'00'])}}
        </div>
        <div class="form-group">
            {{Form::label('description','Detail')}}
            {{Form::textarea('description','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Text'])}}
        </div>
        {{ Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!} 

@endsection
