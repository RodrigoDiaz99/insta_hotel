<?php

namespace App\Http\Controllers;

use App\Models\Compras;
use App\Http\Requests\StoreComprasRequest;
use App\Http\Requests\UpdateComprasRequest;
use App\Models\Almacen;
use App\Models\ComprasDetalles;
use App\Models\Establishment;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\Product_inventory;
use App\Models\Product_type;
use App\Models\Proveedores;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($establishment_id)
    {
        $compras = Compras::where('establishment_id', $establishment_id)->get();
        return view('compras.index', compact('compras', 'establishment_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($establishment_id)
    {
        $establishment = Establishment::where('id', $establishment_id)->first();
        $insumos = Product::where('type', 'Insumo')->get();
        $proveedores = Proveedores::where('establishment_id', $establishment_id)->get();
        return view('compras.create', compact('establishment', 'insumos', 'proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreComprasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComprasRequest $request, $establishment_id)
    {
        try {
            $subtotal = 0;
            DB::beginTransaction();
            $quantity = 0;
            $totalCompra = 0;


            $compra = new Compras();
            $compra->folio = $request->folio;
            $compra->proveedor_id = '1';
            $compra->user_id = Auth::user()->id;
            $compra->establishment_id = $establishment_id;
            $compra->cancelado = '0';
            ($request->hasFile('xmlFile')) ? $compra->path_xml = Storage::putFile('compras_files', $request->file('xmlFile')) : '';
            ($request->hasFile('pdfFile')) ? $compra->path_pdf = Storage::putFile('compras_files', $request->file('pdfFile')) : '';
            ($request->hasFile('ticketFile')) ? $compra->path_ticket = Storage::putFile('compras_files', $request->file('ticketFile')) : '';


            for ($i = 0; $i < count($request->insumo); $i++) {
                /* Obtenemos el total de compra primero */
                $subtotal =  ($request->cantidad[$i]) * ($request->precio_unitario[$i]);
                $totalCompra += $subtotal;
            }

            $compra->total_compra = $totalCompra;
            $compra->save();

            /* ahora guardamos el detalle de compra */
            for ($i = 0; $i < count($request->insumo); $i++) {
                $compras_detalles = new ComprasDetalles();
                $compras_detalles->compra_id = $compra->id;
                $compras_detalles->product_id = $request->insumo[$i];
                $compras_detalles->precio_unitario = $request->precio_unitario[$i];
                $compras_detalles->cantidad_compra = $request->cantidad[$i];
                $compras_detalles->subtotal = ($request->cantidad[$i]) * ($request->precio_unitario[$i]);
                $compras_detalles->save();

                $almacen = Almacen::where('product_id', $compras_detalles->product_id)->get()->first();
                $quantity = $almacen->quantity;
                $quantity += $compras_detalles->cantidad_compra;
                $almacen->quantity = $quantity;
                $almacen->save();
            }
            DB::commit();
            return redirect()->route('compras.index', ['establishment_id' => $establishment_id])->with('success', 'Se ha registrado nuevo producto');
        } catch (\Exception $th) {
            DB::rollBack();
            return back()->with(['error' => 'Error al agregar el registro, por favor, contacte a un administrador del sistema.', 'code' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compras  $compras
     * @return \Illuminate\Http\Response
     */
    public function show($compra_id)
    {
        $compra = Compras::findOrFail($compra_id);
        $compras_detalles = ComprasDetalles::where('compra_id', $compra->id)->get();
        return view('compras.detalles', compact('compra', 'compras_detalles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compras  $compras
     * @return \Illuminate\Http\Response
     */
    public function edit(Compras $compras)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateComprasRequest  $request
     * @param  \App\Models\Compras  $compras
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComprasRequest $request, Compras $compras)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compras  $compras
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compras $compras)
    {
        //
    }

    public function cancel($compras)
    {

        $compra = Compras::find($compras);
        $compra->cancelado = 1;
        $compra->update();

        return redirect()->route('compras.index', ['establishment_id' => $compra->establishment_id])->with(['success' => 'Compra cancelada.']);
    }
}
