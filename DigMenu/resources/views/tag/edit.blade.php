@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between">
    <h1>Edit Tag</h1>
    <a href="/tag">Go back</a>
</div>
    {!! Form::open(['action' => ['TagsController@update',$tag->id],'method'=>'POST']) !!}
        <div class="form-group">
            {{Form::label('name','Tag Name')}}
            {{Form::text('name',$tag->name,['class'=>'form-control','placeholder'=>'Name'])}}
        </div>

        <div class="form-group">
            {{Form::label('color','Color')}}
            {{Form::color('color',$tag->color,['class'=>'form-control','placeholder'=>'#00000'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{ Form::submit('Update',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!} 

@endsection
