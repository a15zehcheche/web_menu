
    <div class="text-center"><h1>La Carta<h1></div>
    <div class="text-right mb-2">
        <a class="btn btn-secondary" href="/food">Add</a>
        <a class="btn btn-primary" href="/menu/create">Create</a>
        <a class="btn btn-warning" href="/tag">Tag</a>
        <a class="btn btn-info" href="/orders">Order</a>
    </div>
    <carta></carta>
<!-- 
@if (count($menus)>0)
        <div class="row">
            @foreach ($menus as $menu)
                <div class="well col-md-3">
                    <div class="card mb-4 shadow-sm"  style="border-top: 5px solid  {{$menu->tag->color}}">
                  
                        <div class="overflow-hidden d-flex align-items-center" style="height:225px;">
                            <img class="bd-placeholder-img card-img-top" width="100%"  src="/storage/images/{{$menu->imgLink}}" alt="">
                        </div>

                        <div class="card-body p-3">
                            <a href="/menu/{{$menu->id}}}"><p class="card-text">{{$menu->name}}</p></a>
                            <h2 class="text-right">{{$menu->price}}€</h2>
                           
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
-->
