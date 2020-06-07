@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between">
        <h1>Edit Menu</h1>
        <a href="/dashboard">Go back</a>
    </div>
    {!! Form::open(['action' => ['MenusController@update',$menu->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name','Menu Name')}}
            {{Form::text('name',$menu->name,['class'=>'form-control','placeholder'=>'Name'])}}
        </div>

        <div class="form-group">
            {{Form::label('price','Price')}}
            {{Form::text('price',$menu->price,['class'=>'form-control','placeholder'=>'00,00'])}}
        </div>
        <div class="form-group">
            {{Form::label('description','Detail')}}
            {{Form::textarea('description',$menu->description,['id'=>'','class'=>'form-control','placeholder'=>'Text'])}}
        </div>
        <div class="form-group">
            {!! Form::Label('tag', 'Tag:') !!}
            {!! Form::select('tag_id', $tags, $menu->tag_id, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::Label('available', 'Available:') !!}
            {!! Form::checkbox('in_stock',$menu->in_stock, $menu->in_stock)!!}

        </div>
        <div class="form-group w-100 overflow-hidden">
            {{Form::file('menu_image')}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{ Form::submit('Update',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!} 
   
@endsection
