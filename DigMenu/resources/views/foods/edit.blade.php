@extends('layouts.app')
@section('content')
    <h1>Edit Food</h1>
    {!! Form::open(['action' => ['FoodsController@update',$food->id],'method'=>'POST']) !!}
        <div class="form-group">
            {{Form::label('name','Food Name')}}
            {{Form::text('name',$food->name,['class'=>'form-control','placeholder'=>'Name'])}}
        </div>

        <div class="form-group">
            {{Form::label('price','Price')}}
            {{Form::number('price',$food->price,['class'=>'form-control','placeholder'=>'00'])}}
        </div>
        <div class="form-group">
            {{Form::label('description','Detail')}}
            {{Form::textarea('description',$food->description,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Text'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{ Form::submit('Update',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!} 

@endsection
