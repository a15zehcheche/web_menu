@extends('layouts.app')
@section('content')
<div class="">


  {!! Form::open(['action' => ['PagesController@search'],'method'=>'POST']) !!}
    <div class="form-inline mt-2 mt-md-0 d-flex justify-content-center align-content-center search-input">
      {{Form::text('search','',['class'=>'form-control w-75 ','placeholder'=>'Store Name'])}}
      {{ Form::submit('Search',['class'=>'btn ml-2 btn-outline-success'])}}
    </div>
  {!! Form::close() !!} 
</div>
<style>
.search-input{
  height: 80vh;
}
@media only screen and (max-width: 600px) {
  .search-input{
    height: auto;
  }
}
</style>
@endsection