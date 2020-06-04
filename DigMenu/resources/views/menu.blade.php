@extends('layouts.app')
@section('content')
<div class="text-center"><h1>La Carta de {{$store_name ?? ''}}<h1></div>
    @if (count($menus)>0)
        <div class="row">
            @foreach ($menus ?? '' as $menu)
                <div class="well col-md-3">
                  
                    <div class="card mb-4 shadow-sm">
                        <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="/storage/images/{{$menu->imgLink}}" alt="">
                        
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
@endsection

