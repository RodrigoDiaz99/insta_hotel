<?php

namespace App\Http\Controllers;

use App\Models\Room_type;
use Illuminate\Http\Request;

class TiposHabitacion extends Controller
{
    public function index($establishment_id)
    {
        $tipos = Room_type::where('establishments_id', $establishment_id)->get();
        return view('rooms.types.index', compact('tipos', 'establishment_id'));
    }

    public function store(Request $request)
    {
        $tipo = new Room_type();
        $tipo->name = $request->name;
        $tipo->establishments_id = $request->establishment_id;
        $tipo->save();
        return back()->with('success', '¡Se guardó con éxito!');
    }


    public function update(Request $request)
    {
        $tipo = Room_type::findOrFail($request->tipo_id);
        $tipo->name = $request->name;
        $tipo->establishments_id = $request->establishment_id;
        $tipo->save();
        return back()->with('success', '¡Se guardó con éxito!');
    }

    public function delete(Request $request)
    {
        
        $tipo = Room_type::findOrFail($request->type_id);
        $tipo->delete();
        return back()->with('success', '¡Se eliminó con éxito!');
    }
}
