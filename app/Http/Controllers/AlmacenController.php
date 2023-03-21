<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Http\Requests\StoreAlmacenRequest;
use App\Http\Requests\UpdateAlmacenRequest;
use App\Models\Establishment;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($establishment_id)
    {

        $almacen = almacen::where('establishment_id', $establishment_id)->get();
        $establishment = Establishment::find($establishment_id);
         return view('almacen.index', compact('almacen', 'establishment_id','establishment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIngredientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIngredientRequest $request, $establishment_id)
    {
        try {
            $ingredient = new Ingredient();
            $ingredient->name = $request->name;
            $ingredient->available_quantity = $request->quantity;
            $ingredient->establishment_id = $establishment_id;
            $ingredient->save();
            return back()->with('success', '¡Se agrego el ingrediente de forma exitosa!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Hubo un error al agregar los datos. Contacta con un administrador del sistema.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredient $ingredient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIngredientRequest  $request
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIngredientRequest $request,  $ingredient)
    {
        try {
            $ingredient = Ingredient::findOrFail($ingredient);
            $ingredient->name = $request->edit_name;
            $ingredient->available_quantity = $request->edit_quantity;
            $ingredient->update();
            return back()->with('success', '¡Se agrego el ingrediente de forma exitosa!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Hubo un error al agregar los datos. Contacta con un administrador del sistema.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    {
        //
    }
}
