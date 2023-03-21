<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeguimientoStore;
use App\Models\Product;
use App\Models\Seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($establishment_id)
    {
        // $pedido=Seguimiento::orderBy('id','asc')->where('establishment_id', $establishment_id)->paginate(10);
        // $producto=Product::orderBy('id','asc')->get();
        // return view('pedido.index',compact('establishment_id', 'pedido','producto'));
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
    public function store(SeguimientoStore $request, $establishment_id)
    {
        try {
            $pedido = new Seguimiento();
            $pedido->products_id = $request->get('products_id');
            $pedido->estatus = 1;
            $pedido->user_created_at = Auth::user()->id;
            $pedido->user_updated_at = Auth::user()->id;
            $pedido->establishment_id = $establishment_id;
            //dd($pedido);
            $pedido->save();
            return back()->with('success', 'Se agrego nuevo pedido de manera exitosa');
        } catch (\Throwable $th) {
            return back()->with('error', 'Hubo un error al agregar los datos.');
        }
    }

    public function seguimiento(Request $request)
    {
        $pedido_id = $request->pedido_id;
        $seguimiento = Seguimiento::where('pedidos_id', $pedido_id)->get();
        return response()->json(['seguimiento' => $seguimiento]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Seguimiento $seguimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Seguimiento $seguimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $pedido = Seguimiento::findOrFail($id);
            if ($pedido->estatus == 1) {
                $pedido->estatus = 2;
                $pedido->update();
                return back()->with('updated', 'Se ha modificado el pedido de manera exitosa');
            } else if ($pedido->estatus == 2) {
                $pedido->estatus = 3;
                $pedido->update();
                return back()->with('updated', 'Se ha modificado el pedido de manera exitosa');
            }
        } catch (\Throwable $th) {

            return back()->with('error', 'Hubo un error al modificar estatus de pedido.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pedido = Seguimiento::find($id);

            $pedido->delete();
            $pedido->estatus = "0";
            $pedido->update();
            return  back()->with('deleted', 'Se elimino correctamente el registro', $id);
        } catch (\Throwable $th) {
            $exception = $th->getMessage();
            return back()->with(['error' => 'No se pudo eliminar el registro, por favor, contacta a un administrado del sistema.', 'code' => $exception]);
        }
    }
}
