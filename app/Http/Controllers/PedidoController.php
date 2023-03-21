<?php

namespace App\Http\Controllers;

use App\Http\Requests\PedidoStore;
use App\Models\Establishment;
use App\Models\Pedido;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($establishment_id)
    {
        $pedido = Pedido::orderBy('id', 'asc')->where('establishment_id', $establishment_id)->get();
        $producto = Product::orderBy('id', 'asc')->get();
$establishment=Establishment::orderBy('id','asc')->get();
        $seguimiento = DB::table('seguimientos')
            ->join('pedidos', 'seguimientos.pedidos_id', '=', 'pedidos.id')

            ->join('products', 'pedidos.products_id', '=', 'products.id')
            ->select('pedidos.estatus', 'products.name', 'seguimientos.estatus', 'seguimientos.created_at')
            ->get();


        return view('pedido.index', compact('establishment_id', 'pedido', 'producto', 'seguimiento','establishment'));
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
    public function store(PedidoStore $request, $establishment_id)
    {
        //dd($request->all());
        try {
            $fecha = Carbon::now();
            DB::beginTransaction();
            $pedido = new Pedido();
            $pedido->products_id = $request->get('products_id');
            $pedido->cantidad= $request->get('cantidad');
            $pedido->estatus = $request->estatus;
            $pedido->user_created_at = Auth::user()->id;
            $pedido->user_updated_at = Auth::user()->id;
            if(!is_null( $request->establishment_id)){
                $pedido->establishment_id = $request->establishment_id;
            }else{
                $pedido->establishment_id=$establishment_id;
            }

            // dd($pedido);
            $pedido->save();
            DB::table('seguimientos')->insert([
                'pedidos_id' => $pedido->id,
                'estatus' => $request->estatus,
                'user_created_at' => Auth::user()->id,
                'user_updated_at' => Auth::user()->id,
                'created_at' => $fecha,

            ]);
            DB::commit();
            return back()->with('success', 'Se agrego nuevo pedido de manera exitosa');
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            return back()->with('error', 'Hubo un error al agregar los datos.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $fecha = Carbon::now();
            $pedido = Pedido::findOrFail($id);
            if ($pedido->estatus == 1) {
                $pedido->estatus = 2;
                $pedido->update();
                DB::table('seguimientos')->insert([

                    'pedidos_id' => $pedido->id,
                    'estatus' => 2,
                    'user_created_at' => Auth::user()->id,
                    'user_updated_at' => Auth::user()->id,
                    'created_at' => $fecha,

                ]);

                return back()->with('updated', 'Se ha modificado el pedido de manera exitosa');
            } else if ($pedido->estatus == 2) {
                $pedido->estatus = 3;
                $pedido->update();
                DB::table('seguimientos')->insert([

                    'pedidos_id' => $pedido->id,
                    'estatus' => 3,
                    'user_created_at' => Auth::user()->id,
                    'user_updated_at' => Auth::user()->id,
                    'created_at' => $fecha,

                ]);
                return back()->with('updated', 'Se ha modificado el pedido de manera exitosa');
            }
        } catch (\Exception $th) {
            dd($th);
            return back()->with('error', 'Hubo un error al modificar estatus de pedido.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pedido = Pedido::find($id);

            $pedido->delete();
            $pedido->estatus = "0";
            $pedido->update();
            return back()->with('deleted', 'Se elimino correctamente el registro', $id);
        } catch (\Throwable $th) {
            $exception = $th->getMessage();
            return back()->with(['error' => 'No se pudo eliminar el registro, por favor, contacta a un administrado del sistema.', 'code' => $exception]);
        }
    }
}
