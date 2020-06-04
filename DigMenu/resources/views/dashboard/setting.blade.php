@extends('layouts.app')
@section('content')
    <h1>Setting Profile</h1>
    {!! Form::open(['action' => ['UserController@update',$user->id],'method'=>'POST']) !!}
        <div class="form-group">
            {{Form::label('store_name','Store Name')}}
            {{Form::text('store_name','store_name test',['class'=>'form-control','placeholder'=>'Name','disabled' => 'disabled'])}}
        </div>
        <div class="form-group">
            {{Form::label('name','Name')}}
            {{Form::text('name',$user->name,['class'=>'form-control','placeholder'=>'Name','disabled' => 'disabled'])}}
        </div>
        <div class="form-group">
            {{Form::label('email','Email')}}
            {{Form::text('email',$user->email,['class'=>'form-control','placeholder'=>'Name','disabled' => 'disabled'])}}
        </div>

        <div class="form-group">
            {{Form::label('address','address')}}
            {{Form::text('address',$user->address,['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('phone_number','Phone Number')}}
            {{Form::text('phone_number',$user->phone_number,['class'=>'form-control'])}}
        </div>
        <div class="form-group d-none">
            {{Form::label('description','Detail')}}
            {{Form::textarea('description',$user->description,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Text'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{ Form::submit('Update',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!} 

@endsection
