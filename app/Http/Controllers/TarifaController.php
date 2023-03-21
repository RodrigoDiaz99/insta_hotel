<?php

namespace App\Http\Controllers;

use App\Http\Requests\TarifaStore;
use App\Models\Room;
use App\Models\Room_type;
use App\Models\Tarifa;
use App\Models\Tramo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TarifaController extends Controller
{
    public function index($establishment_id)
    {
        $tarifa = Tarifa::orderBy('id', 'asc')
            ->where('establishment_id', $establishment_id)
            ->get();

        $habitacion = Room::orderBy('id', 'asc')->get();
        $tipo_habitacion = Room_type::orderBy('id', 'asc')
            ->where('establishments_id', $establishment_id)
            ->get();
        $tramo = Tramo::orderBy('id', 'asc')->get();
        return view('tarifas.index', compact('tarifa', 'habitacion', 'tramo', 'establishment_id', 'tipo_habitacion'));
    }
    public function store(TarifaStore $request, $establishment_id)
    {
        try {
            $carbon = Carbon::now();
            //dd($carbon);
            $tarifa = new Tarifa();
            $tarifa->establishment_id = $establishment_id;

            $tarifa->descripcion_corta = $request->descripcion_corta;
            $tarifa->descripcion_larga = $request->descripcion_larga;
            $tarifa->date_inicio = $request->date_inicio;
            $tarifa->date_fin = $request->date_fin;
            $tarifa->importe = $request->importe;
            $tarifa->suplemento = $request->suplemento;
            $tarifa->time_limpieza = $request->time_limpieza;
            $tarifa->time_lunes = $request->time_lunes;
            $tarifa->time_martes = $request->time_martes;
            $tarifa->time_miercoles = $request->time_miercoles;
            $tarifa->time_jueves = $request->time_jueves;
            $tarifa->time_viernes = $request->time_viernes;
            $tarifa->time_sabado = $request->time_sabado;
            $tarifa->time_domingo = $request->time_domingo;
            $tarifa->permitir_lunes = $request->has('permitir_lunes');
            $tarifa->permitir_martes = $request->has('permitir_martes');
            $tarifa->permitir_miercoles = $request->has('permitir_miercoles');
            $tarifa->permitir_jueves = $request->has('permitir_jueves');
            $tarifa->permitir_viernes = $request->has('permitir_viernes');
            $tarifa->permitir_sabado = $request->has('permitir_sabado');
            $tarifa->permitir_domingo = $request->has('permitir_domingo');
            $tarifa->veinticuatro_horas = $request->has('veinticuatro_horas');
            // $tarifa->estatus = $request->has('estatus');
            if ($request->has('estatus') != 1) {
                $tarifa->estatus = 0;
                $tarifa->deleted_at = $carbon;
            } else {
                $tarifa->estatus = 1;

            }

            $tarifa->forzar_salida = $request->has('forzar_salida');
            $tarifa->incremental = $request->has('incremental');
            $tarifa->user_created_at = Auth::user()->id;
            $tarifa->user_updated_at = null;
          //  $tarifa->rooms_id = $request->rooms_id;
            $tarifa->room_types_id = $request->room_types_id;
            $tarifa->tramos_id = $request->tramos_id;

            $tarifa->save();
            return back()->with('success', 'Se agrego nuevo tarifa de manera exitosa');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
           //return back()->with('error', 'Hubo un error al agregar los datos.');
        }
    }
    public function update(TarifaStore $request, $id)
    {
        try {
            $carbon = Carbon::now();
            //dd($carbon);
            $tarifa = Tarifa::findOrFail($id);
            $tarifa->descripcion_corta = $request->descripcion_corta;
            $tarifa->descripcion_larga = $request->descripcion_larga;
            $tarifa->date_inicio = $request->date_inicio;
            $tarifa->date_fin = $request->date_fin;
            $tarifa->importe = $request->importe;
            $tarifa->suplemento = $request->suplemento;
            $tarifa->time_limpieza = $request->time_limpieza;
            $tarifa->time_lunes = $request->time_lunes;
            $tarifa->time_martes = $request->time_martes;
            $tarifa->time_miercoles = $request->time_miercoles;
            $tarifa->time_jueves = $request->time_jueves;
            $tarifa->time_viernes = $request->time_viernes;
            $tarifa->time_sabado = $request->time_sabado;
            $tarifa->time_domingo = $request->time_domingo;
            $tarifa->permitir_lunes = $request->has('permitir_lunes');
            $tarifa->permitir_martes = $request->has('permitir_martes');
            $tarifa->permitir_miercoles = $request->has('permitir_miercoles');
            $tarifa->permitir_jueves = $request->has('permitir_jueves');
            $tarifa->permitir_viernes = $request->has('permitir_viernes');
            $tarifa->permitir_sabado = $request->has('permitir_sabado');
            $tarifa->permitir_domingo = $request->has('permitir_domingo');
            $tarifa->veinticuatro_horas = $request->has('veinticuatro_horas');
            // $tarifa->estatus = $request->has('estatus');
            if ($request->has('estatus') != 1) {
                $tarifa->estatus = 0;
                $tarifa->deleted_at = $carbon;
            } else {
                $tarifa->estatus = 1;

            }

            $tarifa->forzar_salida = $request->has('forzar_salida');
            $tarifa->incremental = $request->has('incremental');
            $tarifa->user_created_at = null;
            $tarifa->user_updated_at = Auth::user()->id;
            $tarifa->rooms_id = $request->rooms_id;
            $tarifa->tramos_id = $request->tramos_id;

            $tarifa->save();
            return back()->with('success', 'Se ha modificado la tarifa de manera exitosa');
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th);
        }return back()->with('error', 'Hubo un error al agregar los datos.');
    }

    public function destroy($id)
    {
        try {
            $tarifa = Tarifa::find($id);

            $tarifa->delete();
            $tarifa->estatus = "0";
            $tarifa->update();
            return back()->with('deleted', 'Se elimino correctamente el registro', $id);
        } catch (\Throwable $th) {
            $exception = $th->getMessage();
            return back()->with(['error' => 'No se pudo eliminar el registro, por favor, contacta a un administrado del sistema.', 'code' => $exception]);
        }
    }
}
