<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dish;
use App\Models\Drink;
use App\Models\Ingredient;
use App\Models\Unit;
use App\Services\ImageUploader;
use Illuminate\Http\Request;

class DrinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::all();
        $categories = Category::all();
        $drinks = Drink::all();
        return view( 'drinks.index', compact(['drinks', 'categories', 'ingredients']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();
        $ingredients = Ingredient::all();
        return view('drinks.create', compact(['categories', 'units', 'ingredients']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $drink = Drink::create($request->all());
        if ($request->has('image')) {
            $drink->image = ImageUploader::upload($request->image, 'drink', 'image');
        }
        foreach ($request->ingredient_ids as $key => $ingredient) {
            $drink->ingredients()->attach($ingredient, ['value' => $request->counts[$key]]);
        }

        $drink->save();

        return redirect()->route('drinks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function show(Drink $drink)
    {
        return view('drinks.show', compact('drink'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function edit(Drink $drink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drink $drink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drink $drink)
    {
        //
    }
}
