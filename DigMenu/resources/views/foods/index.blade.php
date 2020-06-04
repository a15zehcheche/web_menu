@extends('layouts.app')
@section('content')
<div class="container">
    <!--div class="text-right"><a class="btn btn-primary mb-3" href="/food/create">Create</a></div-->
    {!! Form::open(['action' => ['FoodsController@search'],'method'=>'GET']) !!}
    <div class="form-inline mt-2 mb-5 mt-md-0 d-flex justify-content-center align-content-center search-input">
      {{Form::text('search','',['class'=>'form-control w-75 ','placeholder'=>'Food Name'])}}
      {{Form::hidden('_method','GET')}}
      {{ Form::submit('Search',['class'=>'btn ml-2 btn-outline-success'])}}
    </div>
  {!! Form::close() !!} 
    @if (count($foods)>0)
        <div class="row">
            @foreach ($foods as $food)
                <div class="well col-md-3">
                  
                    <div class="card mb-4 shadow-sm">
                    <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="/storage/images/{{$food->imgLink}}" alt="">
                        <div class="card-body">
                            <p class="card-text">{{$food->name}}</p>
                            <h2 class="text-right">{{$food->price}}€</h2>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="/food/{{$food->id}}}"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                                <a href="/menu/add/{{$food->id}}}"><button type="button" class="btn btn-sm btn-outline-success">Add</button></a>
                            </div>
                        <small class="text-muted">{{$food->created_at}}</small>
                        </div>
                        </div>
                    </div>
                </diV>
            @endforeach
        </div>
        <div class="pages w-100">
            {{$foods->appends($_GET)->links()}}
        </div>

    @else
        <p>No Foods found</p>
    @endif
</div>
<style>
    .pages{
        overflow-x: scroll;
    }
</style>

@endsection
