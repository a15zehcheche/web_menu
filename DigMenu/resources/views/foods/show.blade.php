@extends('layouts.app')
@section('content')
    <a href="/food">Go back</a>
    <div class="well">
        <div class="card mb-4 shadow-sm">
            <div class="overflow-hidden d-flex justify-content-center" style="height:225px;">
                <img style="width:225px" class="bd-placeholder-img card-img-top"  height="100%" src="/storage/images/{{$food->imgLink}}" alt="">
            </div>
            <div class="card-body">
                <h3 class="card-text">{{$food->name}}</h3>
                <p>{!!$food->description!!}</p>
                <div class="d-flex justify-content-between align-items-center">
                <!--div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                    <a class="btn  btn-sm btn-outline-secondary " href="/food/{{$food->id}}/edit">Edit</a>
                    {!! Form::open(['action' => ['FoodsController@destroy',$food->id],'method'=>'POST','class'=>'pull-right']) !!}
                        {{Form::hidden('_method','DELETE')}}
                        {{ Form::submit('Delete',['class'=>'btn btn-sm btn-outline-danger'])}}
                    {!! Form::close() !!} 
                </div-->
                    <small class="text-muted">{{$food->created_at}}</small>
                </div>
            </div>
            </div>  
        
    </diV>

@endsection
