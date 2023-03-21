<?php

namespace App\Http\Controllers;

use App\Models\Incidentes;
use App\Models\Cliente;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class IncidentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = Auth::user();
        $incidentes = Incidentes::orderBy('id','asc')->paginate(20);
         return view('incidentes.index',compact('incidentes','user'));
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
    public function store(Request $request)
    {       
            $user = Auth::user();
            $cliente = Cliente::find('id');
            $incidente = new Incidentes();
            $incidente->nivel = $request->nivel;
            $incidente->mensaje = $request->mensaje;
            $incidente->lugar = $request->lugar;
            $incidente->vsuites = $request->vsuites;
            $incidente->lavanda = $request->lavanda;
            $incidente->cliente_id = $request->cliente_id;
            $incidente->user_id = $user->id;
            $incidente->estado = "activo";
            $incidente->save();
            return redirect()->route('clientes.index')->with('success', 'Se ha registrado el incidente');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incidentes  $incidentes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incidentes  $incidentes
     * @return \Illuminate\Http\Response
     */
    public function edit(Incidentes $incidentes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incidentes  $incidentes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incidentes $incidentes,$id)
    {
        try{
            $user = Auth::user();
            $incidente = Incidentes::findOrFail($id);
            $incidente->nivel = $request->nivel;
            $incidente->mensaje = $request->mensaje;
            $incidente->lugar = $request->lugar;
            $incidente->vsuites = $request->vsuites;
            $incidente->lavanda = $request->lavanda;
            $incidente->cliente_id = $incidente->cliente_id;
            $incidente->user_id = $user->id;
            $incidente->estado = "activo";
            $incidente->update();
            return redirect()->route('incidentes.index')->with('success', 'Se ha actualizado el incidente');
        }catch(\Exception $th){
            return back()->with('error', 'Hubo un error al actualizar los datos.');
        }
    }

    public function delete($id){
        try{
            $incidente = Incidentes::findOrFail($id);
            $incidente->estado = "inactivo";
            $incidente->update();
            return back()->with('succes', 'Se ha eliminado el incidente');
        }catch(\Exception $th){
            return back()->with('error', 'Hubo un error al eliminar los datos.');
        }
        
    }  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incidentes  $incidentes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incidentes $incidentes)
    {
        //
    }
}
