<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\VentasDetalles;
use App\Models\Establishment;
use App\Models\Product;
use App\Models\Almacen;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($establishment_id)
    {
        $ventas = Venta::where('establishment_id', $establishment_id)->get();
        //return view('ventas.index', compact('ventas','establishment_id'));
        return view('ventas.index', compact('ventas','establishment_id'));
    }

    public function ticket($venta_id){
        $ventas = Venta::where('id', $venta_id)->get();
        $ventas_detalles = VentasDetalles::where('venta_id', $venta_id)->get(); 
        $pdf = PDF::loadView('ventas.ticket', compact('ventas','ventas_detalles'))
            ->setPaper('a6')
            ->setOption('isPhpEnabled',true);
        $option = $pdf->getOptions();
        //dd($option);
        $option->setDefaultFont('DejaVu Sans', 'serif');
        dd($option);
        return $pdf->stream('option');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($establishment_id)
    {
        $establishment = Establishment::where('id', $establishment_id)->first();
        $productos = Product::where('type', 'producto')->get();
        $habitaciones = Room::where('status', '2')->get();
        return view('ventas.create', compact('establishment', 'productos','habitaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $establishment_id)
    {
        /*try{*/
            $subtotal = 0;
            DB::beginTransaction();
            $quantity = 0;
            $totalVenta = 0;

            $ventas = new Venta();
            $ventas->folio = $request->folio;
            $ventas->habitacion_id = $request->habitacion_id;
            $ventas->user_id = Auth::user()->id; 
            $ventas->establishment_id = $establishment_id;
            $ventas->tipo_pago = $request->tipo_pago;
            $ventas->cancelado = '0';

            for ($i = 0; $i < count($request->producto); $i++) {
                /* Obtenemos el total de compra primero */
                $subtotal =  ($request->cantidad_venta[$i]) * ($request->precio_unitario[$i]);
                $totalVenta += $subtotal;
            }

            $ventas->total_venta = $totalVenta;
            $ventas->save();

            for ($i = 0; $i < count($request->producto); $i++) {
                $venta_detalle = new VentasDetalles();
                $venta_detalle->venta_id = $ventas->id;
                $venta_detalle->product_id = $request->producto[$i];
                $venta_detalle->cantidad_venta = $request->cantidad_venta[$i];
                $venta_detalle->precio_unitario = $request->precio_unitario[$i];
                $venta_detalle->subtotal = ($request->cantidad_venta[$i]) * ($request->precio_unitario[$i]);
                $venta_detalle->save();

                $almacen = Almacen::where('product_id', $venta_detalle->product_id)->get()->first();
                $quantity = $almacen->quantity;
                $quantity -= $venta_detalle->cantidad_venta;
                $almacen->quantity = $quantity;
                $almacen->save();
            }
            DB::commit();
            return redirect()->route('ventas.index', ['establishment_id' => $establishment_id])->with('success', 'Venta realizada');
        /*}catch(\Exception $th){
            DB::rollBack();
            return back()->with(['error' => 'Error al agregar el registro, por favor, contacte a un administrador del sistema.', 'code' => $th->getMessage()]);
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show($venta_id)
    {
        $ventas = Venta::findOrFail($venta_id);
        $ventas_detalles = VentasDetalles::where('venta_id', $ventas->id)->get();
        return view('ventas.detalles',compact('ventas','ventas_detalles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(venta $venta)
    {
        //
    }

    public function cancel($ventas)
    {

        $ventas = Venta::find($ventas);
        $ventas->cancelado = 1;
        $ventas->update();

        return redirect()->route('ventas.index', ['establishment_id' => $ventas->establishment_id])->with(['success' => 'Venta cancelada.']);
    }
}
