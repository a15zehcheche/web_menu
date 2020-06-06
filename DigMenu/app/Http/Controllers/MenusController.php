<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Menu;
use App\Food;
use App\MenuImage;
use App\Tag;
use App\User;
use App\Http\Controllers\MenuImageController;

class MenusController extends Controller
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
    public function index()
    {
          //$menu = Menu::all();
          $menus = Menu::orderBy('created_at','desc')->paginate(16);
          return view('menu.index')->with('menus',$menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $tags = Tag::where('user_id', $user_id)->pluck('name','id');
        //$tags[0] = "None";
        return view('menu.create', compact('tags', $tags));
    }

    public function add($food_id)
    {
        $food =  Food::find($food_id);
        $menu = new Menu;
        $menu->name = $food->name;
        $menu->description =  $food->description;
        $menu->price = $food->price;
        $menu->imgLink= $food->imgLink;
        $menu->user_id= auth()->user()->id;
        $menu->save();
        return redirect('/dashboard')->with('success','Menu Added');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regex = "/^[0-9]*(,|\.)[0-9][0-9]$/";

        $request->validate([
            'name' =>'required',
            'price'=>array('required','regex:'.$regex),
            'description'=>'max:191',
            'menu_image'=>'image|nullable|max:1999'
        ]);
        if($request->hasFile('menu_image')){
            $filenameWithExt = $request->file('menu_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('menu_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('menu_image')->storeAs('public/images/',$fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }
     

        $menu = new Menu;
        $menu->name = $request->input('name');
        if($request->input('description')){
            $menu->description = $request->input('description');
        }else{
            $menu->description = "";
        }
        $menu->price = $request->input('price');
        $menu->tag_id = $request->input('tag_id');
        $menu->imgLink = $fileNameToStore;
        $menu->user_id= auth()->user()->id;
        $menu->save();
        /*
        $menuImage = new MenuImage;
        $menuImage->menu_id = $menu->id;
        $menuImage->image_name = $fileNameToStore;
        $menuImage->save();
        */
        return redirect('/dashboard')->with('success','Menu Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::find($id);
        return view('menu.show')->with('menu',$menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $tags = Tag::where('user_id', $user_id)->pluck('name','id');
        //$tags[0] = "None";
        //return $tags;
        $menu = Menu::find($id);
        return view('menu.edit',['menu'=>$menu,'tags'=>$tags]);
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

        //$regex = "/^[0-9]*(,|\.)?[0-9]*$/";
        $regex = "/^[0-9]*(,|\.)[0-9][0-9]$/";

        $request->validate([
            'name' =>'required',
            'price'=>array('required','regex:'.$regex),
            'description'=>'max:191',
        ]);
        $menu = Menu::find($id);

        if($request->hasFile('menu_image')){
            $filenameWithExt = $request->file('menu_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('menu_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('menu_image')->storeAs('public/images/',$fileNameToStore);
            /*
            $menuImage = MenuImage::where('menu_id',$id)->first();
            $menuImage->image_name = $fileNameToStore;
            $menuImage->save();
            */
            if($menu->imgLink != 'noimage.jpg'){
                Storage::delete('/public/images/'.$menu->imgLink);
            }
            $menu->imgLink ;
            $menu->imgLink = $fileNameToStore;
        }

        $menu->name = $request->input('name');
        if(!$request->input('description')){
            $menu->description = "";
        }else{
            $menu->description = $request->input('description');
        }
        $menu->price = $request->input('price');
        $menu->tag_id = $request->input('tag_id');
        $menu->save();
        
        return redirect('/dashboard')->with(['success'=>'menu Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        /*
        if(count($menu->images)>0){
            foreach ($menu->images as $image) {
                if($image->image_name != 'noimage.jpg'){
                    Storage::delete('/public/images/'.$image->image_name);
                }
            }
        }
        $MenuImageController = new MenuImageController();
        $MenuImageController->destroyByMenuId($id);
        */
        if($menu->imgLink != 'noimage.jpg'){
            Storage::delete('/public/images/'.$menu->imgLink);
        }
        $menu->delete();
        return redirect('/dashboard')->with(['success'=>'Menu '.$menu->name.' Removed']);
    }
}
