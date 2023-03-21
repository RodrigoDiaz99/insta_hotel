<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $texto = trim($request->get('texto'));
        $cliente = DB::table('clientes')
                    ->select('id','nombre','apellido_p','apellido_m','fecha_n','genero','origen','tipo_documento','documento','expedicion','pais_documento','email','direccion','codigo_postal','poblacion','provincia','telefono_1', 'telefono_2','observaciones','estado')
                    ->where('nombre','LIKE','%'.$texto.'%')
                    ->orWhere('apellido_p','LIKE','%'.$texto.'%')
                    ->orWhere('apellido_m','LIKE','%'.$texto.'%')
                    ->orWhere('documento','LIKE','%'.$texto.'%')
                    ->orWhere('email','LIKE','%'.$texto.'%')
                    ->orderBy('nombre','asc')
                    ->paginate(20);
        
        return view('clientes.index',compact('cliente','texto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $cliente = new cliente();
            $cliente->nombre = $request->nombre;
            $cliente->apellido_p = $request->apellido_p;
            $cliente->apellido_m = $request->apellido_m;
            $cliente->fecha_n = $request->fecha_n;
            $cliente->genero = $request->genero;
            $cliente->origen = $request->origen;
            $cliente->tipo_documento = $request->tipo_documento;
            $cliente->documento = $request->documento;
            $cliente->expedicion = $request->expedicion;
            $cliente->pais_documento = $request->pais_documento;
            $cliente->email = $request->email;
            $cliente->direccion = $request->direccion;
            $cliente->codigo_postal = $request->codigo_postal;
            $cliente->poblacion = $request->poblacion;
            $cliente->provincia = $request->provincia;
            $cliente->telefono_1 = $request->telefono_1;
            $cliente->telefono_2 = $request->telefono_2;
            $cliente->observaciones = $request->observaciones;
            $cliente->estado = "activo";
            $cliente->save();
            return redirect()->route('clientes.index')->with('success', 'Se ha registrado un nuevo cliente');

        }catch(\Exception $th){
            return back()->with('error', 'Hubo un error al agregar los datos.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $clientes, $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente, $id)
    {
        try{
            $cliente = Cliente::findOrFail($id);
            $cliente->nombre = $request->nombre;
            $cliente->apellido_p = $request->apellido_p;
            $cliente->apellido_m = $request->apellido_m;
            $cliente->fecha_n = $request->fecha_n;
            $cliente->genero = $request->genero;
            $cliente->origen = $request->origen;
            $cliente->tipo_documento = $request->tipo_documento;
            $cliente->documento = $request->documento;
            $cliente->expedicion = $request->expedicion;
            $cliente->pais_documento = $request->pais_documento;
            $cliente->email = $request->email;
            $cliente->direccion = $request->direccion;
            $cliente->codigo_postal = $request->codigo_postal;
            $cliente->poblacion = $request->poblacion;
            $cliente->provincia = $request->provincia;
            $cliente->telefono_1 = $request->telefono_1;
            $cliente->telefono_2 = $request->telefono_2;
            $cliente->observaciones = $request->observaciones;
            $cliente->estado = "activo";
            $cliente->update();
            return redirect()->route('clientes.index')->with('success', 'Se ha actualizado los datos del cliente');
        }catch(\Exception $th){
            return back()->with('error', 'Hubo un error al agregar los datos.');
        }
        

    }

    public function delete($id){
        try{
            $cliente = Cliente::findOrFail($id);
            $cliente->estado = "inactivo";
            $cliente->update();
            return back()->with('succes', 'Se ha eliminado el registro');
        }catch(\Exception $th){
            return back()->with('error', 'Hubo un error al agregar los datos.');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $clientes)
    {
        //
    }
}
