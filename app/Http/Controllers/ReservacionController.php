<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservaRequest;
use App\Models\Cliente;
use App\Models\Reservacion;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($establishment_id)

    {
        $reservaciones = Reservacion::where('establishment_id', $establishment_id)->get();
        return view('reservaciones.index', compact('reservaciones'));
    }

    public function habitaciones()
    {
        dd('a');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($room_id)
    {
        $room = Room::findOrFail($room_id);
        $clientes = Cliente::all();
        return view('reservaciones.createFromRoom', compact('room', 'clientes'));
    }

    public function crearReservacion($room_id)
    {
        $room = Room::findOrFail($room_id);
        return view('guest.reservacion', compact('room'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservaRequest $request)
    {
        try {
            $reservacion = new Reservacion();
            $reservacion->room_id = $request->room_id;
            $reservacion->cliente_id = Auth::user()->id;
            $reservacion->establishment_id = $request->establishment_id;
            $reservacion->fecha_entrada = $request->fecha_entrada;
            $reservacion->hora_entrada = $request->hora_entrada;
            $reservacion->tipo_habitacion = $request->tipo_habitacion;
            $codigo = bin2hex(random_bytes(4));

            $reservacion->codigo = $codigo;
            $reservacion->save();
            return response()->json(['message' => '¡Se realizó la reservación con éxito!, su código de reservación es: ' . $codigo, 'redirect' =>  route('rooms.index', $request->establishment_id)], 200);
        } catch (\Exception $ex) {

            return response()->json(['message' => 'Error al guardar reservacion', 'ex' => $ex->getMessage()], 400);
        }
    }

    public function buscar(Request $request)
    {
        try {
            $reservacion = Reservacion::where('codigo', $request->codigo)->get()->first();
            return response()->json(['message' => 'Resultados encontrados', 'redirect' =>  route('ver.reservacion', ['reservacion_id' => $reservacion->id])], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => 'No se obtuvo resultados', 'ex' => $ex->getMessage()], 400);
        }
    }

    public function buscar_cliente(Request $request)
    {
        try {
            $cliente = Cliente::where('Documento', $request->documento)->first();
            if ($cliente) {
                return response()->json([
                    'message' => 'Cliente encontrado',
                    'cliente' => $cliente
                ], 200);
            } else {
                throw new Exception();
            }
        } catch (\Exception $ex) {
            return response()->json(['message' => 'No se obtuvo resultados', 'ex' => $ex->getMessage()], 400);
        }
    }

    public function store_guest(Request $request)
    {
        try {
            $reservacion = new Reservacion();
            $reservacion->room_id = $request->room_id;
            $reservacion->cliente_id = $request->cliente;
            $reservacion->establishment_id = $request->establishment_id;
            $reservacion->fecha_entrada = $request->fecha_entrada;
            $reservacion->hora_entrada = $request->hora_entrada;
            $reservacion->fecha_salida = $request->fecha_salida;
            $reservacion_hora_salida = $request->hora_salida;
            $reservacion->tipo_habitacion = '0';
            $codigo = bin2hex(random_bytes(4));
            $reservacion->codigo = $codigo;
            $reservacion->save();
            return response()->json(['message' => '¡Se realizó la reservación con éxito!, su código de reservación es: ' . $codigo, 'redirect' =>  route('rooms.index', $request->establishment_id)], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => 'Error al guardar reservacion', 'ex' => $ex->getMessage()], 400);
        }
    }

    public function store_guest_register(Request $request)
    {
        try {
            DB::beginTransaction();
            /* Guardar cliente */
            $cliente = new Cliente();
            $cliente->nombre = $request->nombre;
            $cliente->apellido_p = $request->apellido_p;
            $cliente->apellido_m = $request->apellido_m;
            $cliente->email = $request->email;
            $cliente->telefono_1 = $request->telefono1;
            $cliente->telefono_2 = $request->telefono2;
            $cliente->estado = 'activo';
            $cliente->tipo_documento = 'INE';
            $cliente->documento = $request->documento;
            $cliente->save();

             $reservacion = new Reservacion();
             $reservacion->cliente_id = $cliente->id;
            $reservacion->room_id = $request->room_id;
            $reservacion->establishment_id = $request->establishment_id;
            $reservacion->fecha_entrada = $request->fecha_entrada;
            $reservacion->hora_entrada = $request->hora_entrada;
            $reservacion->fecha_salida = $request->fecha_salida;
            $reservacion->hora_salida = $request->hora_salida;
            $reservacion->tipo_habitacion = '0';
            $codigo = bin2hex(random_bytes(4));
            $reservacion->codigo = $codigo;
            $reservacion->save();
            DB::commit();
            return response()->json(['message' => '¡Se realizó la reservación con éxito!, su código de reservación es: ' . $codigo, 'redirect' =>  route('rooms.index', $request->establishment_id)], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => 'Error al guardar reservacion', 'ex' => $ex->getMessage()], 400);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\reservaciones  $reservaciones
     * @return \Illuminate\Http\Response
     */
    public function ver($reservacion_id)
    {
        $reservacion = Reservacion::findOrFail($reservacion_id);
        $room = Room::findOrFail($reservacion->room->id);
        return view('guest.editReservacion', compact('reservacion', 'room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\reservaciones  $reservaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $reservacion = Reservacion::findOrFail($request->reserva_id);
            $codigo = $reservacion->codigo;
            $reservacion->fecha_entrada = $request->fecha_entrada;
            $reservacion->hora_entrada = $request->hora_entrada;
            $reservacion->tipo_habitacion = $request->tipo_habitacion;
            $reservacion->save();
            return response()->json(['message' => '¡Se actualizó la reservación con éxito!, su código de reservación es: ' . $codigo, 'redirect' =>  route('front')], 200);
        } catch (\Exception $ex) {

            return response()->json(['message' => 'Error al actualizar reservacion', 'ex' => $ex->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\reservaciones  $reservaciones
     * @return \Illuminate\Http\Response
     */
    public function cancelar(Request $request)
    {
        try {
            $reservacion = Reservacion::findOrFail($request->reserva_id);
            $reservacion->cancelado = 1;
            if ($request->comentario) {
                $reservacion->comentario = $request->comentario;
            } else {
                $reservacion->comentario = 'Sin comentario';
            }
            $codigo = $reservacion->codigo;

            $reservacion->save();
            return response()->json(['message' => '¡Se canceló la reservación con éxito!, su código de reservación es: ' . $codigo, 'redirect' =>  route('front')], 200);
        } catch (\Exception $ex) {

            return response()->json(['message' => 'Error al cancelar reservacion', 'ex' => $ex->getMessage()], 400);
        }
    }
}
