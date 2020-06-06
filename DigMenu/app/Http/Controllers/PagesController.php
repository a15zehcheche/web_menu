<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\User;
use App\Tag;
class PagesController extends Controller
{
    public function index(){
       
        return view('index');

    } 
    public function search(Request $request){
        $user_name =  $request->input('search');
        $user = User::where('name', '=', $user_name)->first();
        $menus =[];
        $tags=[];
        if($user){
            $menus = Menu::where('user_id', '=', $user->id)->orderBy('created_at','desc')->paginate(16);
            $tags = Tag::where('user_id', '=',$user->id)->orderBy('created_at','desc')->get();
        }
      
       
        $data =[
            'menus'=>$menus,
            'store_name'=> $user_name,
            'user_name'=> $user_name,
            'tags'=>$tags,
        ];
        return view('menu',$data);

        //return view('menu')->with('menus',$menus);
    } 
    public function filter($user_name,$tag_id){
        $user = User::where('name', '=', $user_name)->first();
        $menus = Menu::where('user_id', '=', $user->id)->where('tag_id', $tag_id) ->orderBy('created_at','desc')->paginate(16);
        $tags = Tag::where('user_id', '=',  $user->id)->orderBy('created_at','desc')->get();

       
        $data =['menus'=>$menus,'tags'=>$tags];
        return view('filter',compact('menus','tags','user_name'));
    }
    public function carta($user_name){
        $user = User::where('name', '=', $user_name)->first();
        $menus =[];
        if($user){
            $menus = Menu::where('user_id', '=', $user->id)->orderBy('created_at','desc')->paginate(16);
        }
      
        $tags = Tag::where('user_id', '=',$user->id)->orderBy('created_at','desc')->get();
        $data =[
            'menus'=>$menus,
            'store_name'=> $user_name,
            'user_name'=> $user_name,
            'tags'=>$tags,
        ];
        return view('menu',$data);

       
    }


    public function profile(){
        return view('pages.profile');
    } 
}
