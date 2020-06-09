@extends('layouts.app')
@section('content') 

<carta-guest user_name="{{$user_name}}"/> 
    <!--
    @if ($tags)
        <div class="text-center"><h1>La Carta de {{$store_name ?? ''}}<h1></div>
        
    <div class="d-flex mb-3 h-100 flex-wrap" >
        @foreach ($tags as $tag)
            <a href="/menufilter/{{$user_name}}/{{$tag->id}}"><div class="tag ml-2 mb-2 btn text-nowrap" style="background-color: {{$tag->color}}">{{$tag->name}}</div></a>
        @endforeach
        <a href="/carta/{{$user_name}} "><div class="tag ml-2 mb-2 btn text-nowrap" style="background-color: #a5a5a5">All</div></a>
      
    </div>
    @endif
  
    @if (count($menus)>0)
        <div class="row">
            @foreach ($menus ?? '' as $menu)
            <div class="well col-md-3">
                <div class="card mb-4 shadow-sm"  style="border-top: 5px solid  {{$menu->tag->color}}">
              
                    <div class="overflow-hidden d-flex align-items-center" style="height:225px;">
                        <img class="bd-placeholder-img card-img-top" width="100%"  src="/storage/images/{{$menu->imgLink}}" alt="">
                    </div>
  
                    <div class="card-body p-3">
                        <a href="/menu/{{$menu->id}}}"><p class="card-text">{{$menu->name}}</p></a>
                       
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">{{$menu->created_at}}</small>
                            <h2 class="text-right">{{$menu->price}}€</h2>
                        </div>
                    </div>
                </div>
            </diV>
              
            @endforeach
            {{$menus ?? ''->links()}}
        </div>
    @else
        <p>No Menu found</p>
    @endif
    -->
@endsection

