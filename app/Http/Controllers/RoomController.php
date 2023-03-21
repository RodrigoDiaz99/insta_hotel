<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use App\Models\Reserva;
use App\Models\Room;
use App\Models\Room_section;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($establishment_id)
    {

        $rooms = Room::where('establishments_id', $establishment_id)->get();
        $establishment=Establishment::orderBy('id','asc')->get();
        return view('rooms.index', compact('rooms', 'establishment_id'));
    }

    public function listRoomForGuest($establishment_id)
    {

        $rooms = Room::where('establishments_id', $establishment_id)->where('status', '1')->get();
        $establishment =  Establishment::findOrFail($establishment_id);

        return view('guest.listarHabitaciones', compact('rooms', 'establishment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($establishment_id)
    {
        $establishment =  Establishment::findOrFail($establishment_id);
        $roomSections = Room_section::where('establishments_id', $establishment_id)->get();
        return view('rooms.create', compact('establishment', 'roomSections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $establishment_id)
    {
        try {
            DB::beginTransaction();
            $room = new Room();
            $room->establishments_id = $establishment_id;
            $room->name = $request->name;
            $room->price = $request->precio;
            $room->room_types_id = $request->room_type;
            $room->room_capacity = $request->capacidad;
            $room->description = $request->description;
            $room->status = '1';
            $room->save();

            DB::commit();
            return redirect()->route('rooms.index', $establishment_id)->with('success', 'Se ha registrado la habitación.');
        } catch (\Exception $th) {
            DB::rollBack();
            throw new Exception($th->getMessage());
        }
    }

    public function update(Request $request,$id){
        try {
            DB::beginTransaction();
            $room =Room::findOrFail($id);

            $room->name = $request->name;
            $room->price = $request->precio;
           // $room->room_types_id = $request->room_type;
            $room->room_capacity = $request->capacidad;
            $room->description = $request->description;
            $room->status = '1';
            //dd($room);
            $room->save();

            DB::commit();
            return back()->with('success', 'Se ha registrado la habitación.');
        } catch (\Exception $th) {
            DB::rollBack();
            throw new Exception($th->getMessage());
        }
    }
    public function status(Request $request)
    {
        $card_color = null;

        $room = Room::findOrFail($request->room_id);
        $room->status = $request->status;
        $status = '';
        switch ($request->status) {
            case 1:
                $card_color = 'bg-success';
                $status = 'Disponible desde:';
                break;
            case 2:
                $card_color = 'bg-danger';
                $status = 'Ocupado desde:';
                break;
            case 3:
                $card_color = 'bg-primary';
                $status = 'Checking-out desde:';
                break;
            case 4:
                $card_color = 'bg-darker';
                $status = 'No disponible desde:';
                break;
        }
        $room->save();
        return response()->json(['message' => '¡Se realizó el cambio con éxito!', 'color' =>  $card_color, 'updated_at' => date($room->updated_at), 'status' => $status], 200);
    }
    public function destroy($id)
    {
        try {
            $room = Room::find($id);

            $room->delete();
            return back()->with('deleted', 'Se elimino correctamente el registro', $id);
        } catch (\Throwable $th) {
           // dd($th);
            return back()->with('deleted', 'No se pudo eliminar el registro');
        }
    }
}
