<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use App\Http\Requests\StoreProveedoresRequest;
use App\Http\Requests\UpdateProveedoresRequest;
use NunoMaduro\Collision\Contracts\Provider;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($establishment_id)
    {
        $proveedores = Proveedores::orderBy('id', 'asc')->where('establishment_id', $establishment_id)->paginate(10);
        return view('proveedores.index', compact('establishment_id', 'proveedores'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProveedoresRequest $request, $establishment_id)
    {
        try {

            $proveedor = new Proveedores();
            $proveedor->nombre = $request->name;
            $proveedor->direccion = $request->direccion;
            $proveedor->numero = $request->numero;
            $proveedor->establishment_id = $establishment_id;
             $proveedor->save();
            return back()->with('success', 'Se agrego el proveedor de manera exitosa');
            // return redirect()->route('product.index')->with('success', 'Se ha registrado nuevo producto');
        } catch (\Exception $th) {
            return back()->with('error', 'Hubo un error al agregar los datos.');
        }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProveedoresRequest $request, $id)
    {
        try {

            $proveedor = Proveedores::findOrFail($id);
            $proveedor->nombre = $request->name;
            $proveedor->direccion = $request->direccion;
            $proveedor->numero = $request->numero;

             $proveedor->update();
            return back()->with('success', 'Se agrego el proveedor de manera exitosa');
            // return redirect()->route('product.index')->with('success', 'Se ha registrado nuevo producto');
        } catch (\Exception $th) {
            //dd($th);
           return back()->with('error', 'Hubo un error al agregar los datos.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $proveedor = Proveedores::find($id);

            $proveedor->delete();
            return back()->with('deleted', 'Se elimino correctamente el registro', $id);
        } catch (\Throwable $th) {
           // dd($th);
            return back()->with('deleted', 'No se pudo eliminar el registro');
        }
    }
}
