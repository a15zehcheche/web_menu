<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\User;
class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if($user_id){
            $menus = Menu::where('user_id', '=', $user_id)->orderBy('created_at','desc')->paginate(16);
        }
        //return $menus->first()->images;
        return view('dashboard')->with('menus',$menus);
    }

    public function setting()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
    
        return view('dashboard.setting')->with('user',$user );
    }
}
