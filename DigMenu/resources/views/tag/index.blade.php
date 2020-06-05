@extends('layouts.app')
@section('content')
    <div class="text-center"><h1>Tags<h1></div>
    <div class="text-right">
        <a class="btn btn-primary mb-5" href="/tag/create">Create</a>
    </div>
    @if (count($tags)>0)
        <div class="row">
            @foreach ($tags as $tag)
                <div class="well col-md-3">
                  
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body p-3" style="background-color:{{$tag->color}}">
                            <p class="card-text">{{$tag->name}}</p>   
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{$tag->created_at}}</small>

                                <div class="btn-group">
                                    {!! Form::open(['action' => ['TagsController@destroy',$tag->id],'method'=>'POST','class'=>'pull-right']) !!}
                                        {{Form::hidden('_method','DELETE')}}
                                        <a class="btn  btn-sm btn-outline-secondary " href="/tag/{{$tag->id}}/edit">Edit</a>
                                        {{ Form::submit('Delete',['class'=>'btn btn-sm btn-outline-danger'])}}
                                    {!! Form::close() !!} 
                                </div>
                            </div>
                        </div>
                    </div>
                </diV>
            @endforeach
            {{$tags->links()}}
        </div>
    @else
        <p>No tag found</p>
    @endif

@endsection
