<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComandaStore;
use App\Models\Comanda;
use App\Models\Room;
use App\Models\TipoDispositivo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ComandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($establishment_id)
    {
        $comanda = Comanda::orderBy('id', 'asc')
            ->where('establishment_id', $establishment_id)
            ->get();
        $habitacion = Room::orderBy('id', 'asc')->get();
        // $dispositivo = TipoDispositivo::orderBy('id', 'asc')
        //     ->where('establishments_id', $establishment_id)
        //     ->get();

        return view('comanda.index', compact('comanda', 'habitacion', 'establishment_id'));
    }

    public function getComandas()
    {

        $comanda = Comanda::join('rooms', 'comandas.room_id', '=', 'rooms.id')
            ->select('comandas.llave_comanda', 'rooms.name', 'comandas.id')
            ->get();

        return $comanda;
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
    public function store(ComandaStore $request, $establishment_id)
    {
        $carbon = Carbon::now();
        try {
            $comanda = new Comanda();
            $comanda->establishment_id = $establishment_id;
            $comanda->room_id = $request->room_id;
            $comanda->clave = $request->clave;
            $comanda->llave_comanda = $request->llave_comanda;
            $comanda->estatus = $request->estatus;
            $comanda->created_at = $carbon;
            $comanda->save();
            return back()->with('success', 'Se agrego de manera exitosa la comanda');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('error', 'Hubo un error al agregar los datos.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function show(Comanda $comanda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function edit(Comanda $comanda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function update(ComandaStore $request, $id)
    {
        try {
            $comanda = Comanda::findOrFail($id);
            $comanda->llave_comanda = $request->llave_comanda;
            $comanda->tipo_dispositivo_id = $request->tipo_dispositivo_id;
            $comanda->rooms_id = $request->rooms_id;
            $comanda->save();
            return back()->with('success', 'Se actualizo la comanda de manera exitosa');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('error', 'Hubo un error al actualizar los datos.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comanda $comanda, $id)
    {
        try {
            $comanda = Comanda::find($id);

            $comanda->delete();
            $comanda->estatus = 0;
            $comanda->update();
            return back()->with('deleted', 'Se elimino correctamente el registro', $id);
        } catch (\Throwable $th) {
            $exception = $th->getMessage();
            return back()->with(['error' => 'No se pudo eliminar el registro, por favor, contacta a un administrado del sistema.', 'code' => $exception]);
        }
    }
}
