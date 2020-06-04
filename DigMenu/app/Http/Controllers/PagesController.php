<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\User;
class PagesController extends Controller
{
    public function index(){
       
        return view('index');

    } 
    public function search(Request $request){
        $user_name =  $request->input('search');

        $user = User::where('name', '=', $user_name)->first();
        $menus =[];
        if($user){
            $menus = Menu::where('user_id', '=', $user->id)->orderBy('created_at','desc')->paginate(16);
        }
        $data =[
            'menus'=>$menus,
            'store_name'=> $user_name,
        ];
        return view('menu',$data);

        return view('menu')->with('menus',$menus);
    } 
    public function menu($user_name){
        $user = User::where('name', '=', $user_name)->first();
        $menus =[];
        if($user){  
            $menus = Menu::where('user_id', '=', $user->id)->orderBy('created_at','desc')->paginate(16);
        }
        return view('menu')->with('menus',$menus);

       
    }


    public function profile(){
        return view('pages.profile');
    } 
}
