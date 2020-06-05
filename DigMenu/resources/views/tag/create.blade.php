@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between">
        <h1>Create Tag</h1>
        <a href="/tag">Go back</a>
    </div>
        
   
    {!! Form::open(['action' => 'TagsController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name','Tag Name')}}
            {{Form::text('name','',['class'=>'form-control','placeholder'=>'Name'])}}
        </div>

        <div class="form-group">
            {{Form::label('color','Color')}}
            {{Form::color('color','',['class'=>'form-control','placeholder'=>'#00000'])}}
        </div>
 
        {{ Form::submit('Craete',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!} 

@endsection
