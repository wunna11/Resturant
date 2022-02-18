<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dishes = Dish::all();
        return view('kitchen.dish', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Category::all();
        return view('kitchen.create_dish', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDishRequest $request)
    {
        $dish = new Dish();
        $dish->name = request('name');
        $dish->category_id = request('category');
        $dish->price = request('price');

        $image = request('image');
        $imageName = uniqid()."_".$image->getClientOriginalName();
        $image->move(public_path("images/dishes/"), $imageName);
        $dish->image = $imageName;
        
        $dish->save();

        return redirect()->route('dish.index')->with('message', 'Dish is created!');
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
    public function edit(Dish $dish)
    {
        $cats = Category::all();
        return view('kitchen.edit_dish', compact('dish', 'cats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDishRequest $request, Dish $dish)
    {
        $dish->name = request('name');
        $dish->category_id = request('category');
        $dish->price = request('price');

        if(request('image')) {
            $image = request('image');
            $imageName = uniqid()."_".$image->getClientOriginalName();
            $image->move(public_path("images/dishes/"), $imageName);
            $dish->image = $imageName;
        }
        $dish->update();

        return redirect()->route('dish.index')->with('message', 'Dish is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();
        return back()->with('message', 'Dish is deleted successfully!');
    }
}
