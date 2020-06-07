@extends('layouts.app')
@section('content')
    <h1>Create Menu</h1>
   
    {!! Form::open(['action' => 'MenusController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name','Menu Name')}}
            {{Form::text('name','',['class'=>'form-control','placeholder'=>'Name'])}}
        </div>

        <div class="form-group">
            {{Form::label('price','Price')}}
            {{Form::text('price','',['class'=>'form-control','placeholder'=>'00,00'])}}
        </div>
        <div class="form-group">
            {{Form::label('description','Detail')}}
            {{Form::textarea('description','',['id'=>'','class'=>'form-control','placeholder'=>'Text'])}}
        </div>
        <div class="form-group">
            {!! Form::Label('tag', 'Tag:') !!}
            {!! Form::select('tag_id', $tags, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group w-100 overflow-hidden">
            {{Form::file('menu_image')}}
        </div>
        {{ Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!} 
    
@endsection
