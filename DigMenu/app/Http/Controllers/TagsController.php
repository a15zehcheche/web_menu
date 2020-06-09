<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\User;
use App\Menu;   

class TagsController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware('auth');
   }
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(Request $request)
   {
        if($request->ajax()){
            $user_id = auth()->user()->id;
            $user = User::find($user_id);
        return Tag::where('user_id', '=', $user_id)->orderBy('created_at','desc')->get();
            
        }else{
            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            if($user_id){
                $tags = Tag::where('user_id', '=', $user_id)->orderBy('created_at','desc')->paginate(16);
            }
            return view('tag.index')->with('tags',$tags);
        }
        
   }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required',
            'color'=>'required',
        ]);

        $tag = new Tag;
        $tag->name = $request->input('name');
        $tag->color = $request->input('color');
        $tag->user_id= auth()->user()->id;
        $tag->save();
      
        return redirect('/tag')->with('success','Tag Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('tag.edit',['tag'=>$tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>'required',
            'color'=>'required',
        ]);

        $tag = Tag::find($id);
        $tag->name = $request->input('name');
        $tag->color = $request->input('color');
        //$tag->user_id= auth()->user()->id;
        $tag->save();
      
        return redirect('/tag')->with('success','Tag Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menus = Menu::where('tag_id',$id)->get();
        foreach($menus as $menu){
            $menu->tag_id = 0;
            $menu->save();
        }
        $tag = Tag::find($id);
        $tag->delete();
        return redirect('/tag')->with('success','Tag Removed');
    }
}
