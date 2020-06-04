@extends('layouts.app')
@section('content')
    <div class="text-center"><h1>La Carta<h1></div>
    <div class="text-right">
        <a class="btn btn-primary mb-5" href="/menu/create">Create</a>
    </div>
    @if (count($menus)>0)
        <div class="row">
            @foreach ($menus as $menu)
                <div class="well col-md-3">
                  
                    <div class="card mb-4 shadow-sm">
                    <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="{{$menu->imgLink}}" alt="">
                        <div class="card-body p-3">
                            <a href="/menu/{{$menu->id}}}"><p class="card-text">{{$menu->name}}</p></a>   
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{$menu->created_at}}</small>

                                <div class="btn-group">
                                    {!! Form::open(['action' => ['MenusController@destroy',$menu->id],'method'=>'POST','class'=>'pull-right']) !!}
                                        {{Form::hidden('_method','DELETE')}}
                                        <a class="btn  btn-sm btn-outline-secondary " href="/menu/{{$menu->id}}/edit">Edit</a>

                                        {{ Form::submit('Delete',['class'=>'btn btn-sm btn-outline-danger'])}}
                                    {!! Form::close() !!} 
                                </div>
                            </div>
                        </div>
                    </div>
                </diV>
            @endforeach
            {{$menus->links()}}
        </div>
    @else
        <p>No Menu found</p>
    @endif

@endsection
