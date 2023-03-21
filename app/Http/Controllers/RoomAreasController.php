<?php

namespace App\Http\Controllers;

use App\Models\Room_section;
use App\Models\Room_type;
use Illuminate\Http\Request;

class RoomAreasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($establishment_id)
    {
        $areas = Room_section::where('establishments_id', $establishment_id)->get();
        return view('rooms.areas.index', compact('establishment_id','areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            $room_type = new Room_section();
            $room_type->establishments_id = $establishment_id;
            $room_type->name = $request->name;
            $room_type->save();
            return back()->with('success', 'Se ha registrado un nuevo área de habitación.');
        } catch (\Exception $th) {
            //throw $th;
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
    public function update(Request $request, $id)
    {
        try {
            $room_type = Room_section::findOrFail($id);
            $room_type->name = $request->name;


            $room_type->update();
            return back()->with('updated', 'Se ha modificado el tramo de manera exitosa');
        } catch (\Throwable $th) {
            // return response()->json($th->getMessage());
            return back()->with('error', 'Hubo un error al modificar los datos.');
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
            $room_type = Room_section::find($id);

            $room_type->delete();


            return  back()->with('deleted', 'Se elimino correctamente el registro', $id);
        } catch (\Throwable $th) {
            $exception = $th->getMessage();
            return back()->with(['error' => 'No se pudo eliminar el registro, por favor, contacta a un administrado del sistema.', 'code' => $exception]);
        }
    }
}
