<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
class FoodsController extends Controller
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
        //$foods = Food::all();
        $foods = Food::orderBy('created_at','desc')->paginate(16);

        return view('foods.index')->with('foods',$foods);
    }

    public function search(Request $request)
    {
        $serch_name = $request->input('search');
        $foods = Food::where('name','LIKE' ,'%'.$serch_name.'%')->orderBy('created_at','desc')->paginate(16);
        return view('foods.index')->with('foods',$foods);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('foods.create');

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
            'price'=>'required',
            'description'=>'max:191',
        ]);
        $food = new Food;
        $food->name = $request->input('name');
        if($request->input('description')){
            $food->description = $request->input('description');
        }else{
            $food->description = "";
        }
        $food->price = $request->input('price');
        $food->imgLink= 'http://dummyimage.com/241x222.jpg/cc0000/ffffff'; //test
        $food->save();
        
        return redirect('/food')->with('success','Food Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $food = Food::find($id);
        return view('foods.show')->with('food',$food);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $food = Food::find($id);
        return view('foods.edit')->with('food',$food);
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
            'price'=>'required',
            'description'=>'max:191',
        ]);

        $food = Food::find($id);
        $food->name = $request->input('name');
        if($request->input('description')){
            $food->description = $request->input('description');
        }else{
            $food->description = "";
        }
        $food->price = $request->input('price');
        $food->imgLink= 'http://dummyimage.com/241x222.jpg/cc0000/ffffff'; //test
        $food->save();
        
        return redirect('/food')->with(['success'=>'Food Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::find($id);
        $food->delete();
        return redirect('/food')->with(['success'=>'Food Removed']);
    }

}
