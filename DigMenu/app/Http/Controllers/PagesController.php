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
    public function carta(Request $request,$user_name){
       
        $user = User::where('name', '=', $user_name)->first();
        $menus =[];
        if($user){
            $menus = Menu::where('user_id', '=', $user->id)->orderBy('created_at','desc')->paginate(16);
        }else{
            return view('index')->with('error','user not found!');;
        }
      
        $tags = Tag::where('user_id', '=',$user->id)->orderBy('created_at','desc')->get();
        $data =[
            'menus'=>$menus,
            'store_name'=> $user_name,
            'user_name'=> $user_name,
            'user_id'=>$user->id,
            'tags'=>$tags,
        ];
        if($request->ajax()){
            $menus = Menu::where('user_id', '=', $user->id)->orderBy('created_at','desc')->get();
            foreach ($menus as $key => $menu){
                $menus[$key]->tag = $menus[$key]->tag;
            }
            $data =[
                'menus'=>$menus,
                'tags'=>$tags,
            ];
            return $data;
        }
        return view('menu',$data);

       
    }
   


    public function profile(){
        return view('pages.profile');
    } 
    
    public function orders()
    {
        //return view('chat');
        $user_name = auth()->user()->name;
        return view('dashboard.order')->with('user_name',$user_name);
    }
    public function chat()
    {
        return view('chat');
    }
}
