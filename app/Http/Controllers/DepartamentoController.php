<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartamentoStore;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($establishment_id)
    {

        $departamento=Departamento::orderBy('id','asc')->where('establishment_id', $establishment_id)->paginate(10);

        return view('departamento.index',compact('establishment_id', 'departamento'));
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
    public function store(DepartamentoStore $request,$establishment_id)
    {
        try {
            $departamento = new Departamento();
            $departamento->nombre = $request->nombre;
            $departamento->descripcion=$request->descripcion;
            $departamento->establishment_id=$establishment_id;
            $departamento->user_created_at = Auth::user()->id;
            $departamento->user_updated_at =Auth::user()->id;
            $departamento->save();
            return back()->with('success', 'Se agrego un nuevo departamento de manera exitosa');
        } catch (\Throwable $th) {
            //throw $th;
            //dd($th);
            return back()->with('error', 'Hubo un error al agregar los datos.');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Departamento $departamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamento $departamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(DepartamentoStore $request, $id)
    {
        try {
            $departamento = Departamento::findOrFail($id);
            $departamento->nombre = $request->nombre;
            $departamento->descripcion=$request->descripcion;
            $departamento->user_updated_at =Auth::user()->id;
            $departamento->update();
            return back()->with('success', 'Se modifico el departamento de manera exitosa');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            return back()->with('error', 'Hubo un error al agregar los datos.');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $departamento = Departamento::find($id);

            $departamento->delete();
            //$departamento->estatus = "0";
           // $departamento->update();
            return  back()->with('deleted','Se elimino correctamente el registro', $id);
        } catch (\Throwable $th) {
            $exception = $th->getMessage();
            return back()->with(['error' => 'No se pudo eliminar el registro, por favor, contacta a un administrado del sistema.', 'code' => $exception]);
        }
    }
}
