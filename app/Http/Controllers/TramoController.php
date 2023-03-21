<?php

namespace App\Http\Controllers;

use App\Http\Requests\TramoStore;
use App\Models\Tramo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TramoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($establishment_id)
    {
        $tramo = Tramo::orderBy('id', 'asc')->where('establishment_id', $establishment_id)->paginate(10);

        return view('tramos.index', compact('establishment_id', 'tramo'));
    }

    public function gridTramos()
    {
        try {
            $tramo = Tramo::select('id', 'name', 'description', 'time', 'estatus')->get();
            return $tramo;

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
                'mensaje' => 'Conctartarse con soporte si no puede visualizar la tabla de datos',
            ]);
        }
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
    public function store(TramoStore $request, $establishment_id)
    {
        try {
            $tramo = new Tramo();
            $tramo->name = $request->name;
            $tramo->description = $request->description;
            $tramo->time = $request->time;
            $tramo->estatus = "Activo";
            $tramo->establishment_id = $establishment_id;
            $tramo->save();
            return back()->with('success', 'Se agrego nuevo tramo de manera exitosa');
        } catch (\Throwable $th) {
            // return response()->json($th->getMessage());
            return back()->with('error', 'Hubo un error al agregar los datos.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tramo  $tramo
     * @return \Illuminate\Http\Response
     */
    public function show(Tramo $tramo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tramo  $tramo
     * @return \Illuminate\Http\Response
     */
    public function edit(Tramo $tramo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tramo  $tramo
     * @return \Illuminate\Http\Response
     */
    public function update(TramoStore $request, $id)
    {


        try {
            $tramo = Tramo::findOrFail($id);
            $tramo->name = $request->name;
            $tramo->description = $request->description;
            $tramo->time = $request->time;
            $tramo->user_updated_at = Auth::user()->id;

            $tramo->update();
            return back()->with('updated', 'Se ha modificado el tramo de manera exitosa');
        } catch (\Throwable $th) {
            // return response()->json($th->getMessage());
            return back()->with('error', 'Hubo un error al modificar los datos.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tramo  $tramo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tramo $tramo, $id)
    {
        try {
            $tramo = Tramo::find($id);

            $tramo->delete();
            $tramo->estatus = "Inactivo";
            $tramo->update();
            return back()->with('deleted', 'Se elimino correctamente el registro', $id);
        } catch (\Throwable $th) {
            $exception = $th->getMessage();
            return back()->with(['error' => 'No se pudo eliminar el registro, por favor, contacta a un administrado del sistema.', 'code' => $exception]);
        }
    }
}
