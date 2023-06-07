<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Dish;
use App\Models\Ingredient;
use App\Models\Unit;
use App\Services\ImageUploader;
use Illuminate\Http\Request;

class DishController extends Controller
{


    public function cart()
    {
        return view('cart');
    }
    public function addToCart($id)
    {
        $dish = Dish::find($id);

        if(!$dish) {

            abort(404);

        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                $id => [
                    "name" => $dish->name,
                    "quantity" => 1,
                    "price" => $dish->cost,
                    "photo" => $dish->image
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $dish->name,
            "quantity" => 1,
            "price" => $dish->cost,
            "image" => $dish->image
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::all();
        $categories = Category::all();
        $dishes = Dish::all();
        return view( 'dishes.index', compact(['dishes', 'categories', 'ingredients']));
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
        return view('dishes.create', compact(['categories', 'units', 'ingredients']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dish = Dish::create($request->all());
        if ($request->has('image')) {
            $dish->image = ImageUploader::upload($request->image, 'dish', 'image');
        }
        foreach ($request->ingredient_ids as $key => $ingredient) {
            $dish->ingredients()->attach($ingredient, ['value' => $request->counts[$key]]);
        }

        $dish->save();

        return redirect()->route('dishes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        return view('dishes.show', compact('dish'));
    }


    public function edit(Dish $dish)
    {
        return view('dishes.edit', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request, Dish $dish)
//    {
//        $dish->update($request->all());
//
//        return redirect()->route('dishes.index');
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        return view('dishes.delete', compact('dish'));
        $dish->delete();
        return redirect()->route('dishes.index');
    }
}
