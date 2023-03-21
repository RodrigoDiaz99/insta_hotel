<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStore;
use App\Models\Almacen;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\ProductFamily;
use App\Models\Product_inventory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($establishment_id)
    {
        $productfamily = ProductFamily::orderBy('id', 'asc')->get();
        $productinventory = Product_inventory::orderBy('id', 'asc')->get();
        $producto = Product::orderBy('id', 'asc')->where('establishments_id', $establishment_id)->get();
        $ingredients = Ingredient::where('establishment_id', $establishment_id)->get();

        return view('products.index', compact('establishment_id', 'productfamily', 'productinventory', 'producto', 'ingredients'));
    }
    public function gridProductos($establishment_id)
    {

        try {
            $producto = Product::with('ingredients')->with('product_families')->orderBy('id', 'asc')->where('establishments_id', $establishment_id)->get();
            return $producto;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return null;
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStore $request, $establishment_id)
    {
        try {
            DB::beginTransaction();

            $producto = new Product();
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = Storage::putFile('product_images', $request->file('image'));
            $producto->path = $path;
            $producto->name = $request->name;
            $producto->description = $request->description;
            $producto->receta = 0;
            $producto->type = $request->producttype;
            $producto->establishments_id = $establishment_id;
            $producto->product_families_id = $request->product_families_id;
            $producto->save();

            $almacen = new Almacen();
            $almacen->product_id = $producto->id;
            $almacen->quantity = 0;
            $almacen->establishment_id = $establishment_id;
            $almacen->save();
            DB::commit();
            return back()->with('success', 'Se ha registrado nuevo producto');
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();

            throw new Exception($th->getMessage());
        }
    }

    public function storeRecipe(ProductStore $request, $establishment_id)
    {
        //dd($request->all());
        try {

            $producto = new Product();
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = Storage::putFile(
                'product_images',
                $request->file('image')
            );
            $producto->path = $path;
            $producto->name = $request->name;
            $producto->description = $request->description;
            $producto->receta = 1;
            // $producto->type = $request->producttype;
            $producto->establishments_id = $establishment_id;
            $producto->product_families_id = $request->product_families_id;
            if($request->usedQuantity != 0 && $request->currentRecipe !=0){
                $quantity = $request->usedQuantity;
                $ingredient_id = $request->currentRecipe;
            }else{
                $quantity = 0;
                $ingredient_id = 0;
            }

            $producto->save();
            if ($quantity !=0 || $ingredient_id!=0) {
                for ($i = 0; $i < count($ingredient_id); $i++) {
                    $producto->ingredients()->attach($ingredient_id[$i], ['quantity' => $quantity[$i]]);
                    $ingredient = Ingredient::findOrFail($ingredient_id[$i]);
                    $ingredient_quantity = $ingredient->available_quantity;
                    $new_quantity = $ingredient_quantity - $quantity[$i];

                    if ($new_quantity < 0) {
                        throw new Exception('Value cannot be less than zero.');
                    }
                    $ingredient->available_quantity = $new_quantity;
                    $ingredient->save();
                }
            }

            return back()->with('success', 'Se ha registrado nuevo producto');
        } catch (\Exception $th) {

            return back()->with(['error' => 'Error al agregar el registro, por favor, contacte a un administrador del sistema.', 'code' => $th->getMessage()]);
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
    public function edit(Request $request)
    {
        $producto = Product::find($request->id);
        if (!$producto) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'query' => $request->id,
            ], 404);
        }

        return response()->json($producto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $producto = Product::findOrFail($request->id);
            $producto->name = $request->name;
            $producto->product_types_id = $request->product_types_id;
            $producto->description = $request->description;
            $producto->user_updated_at = Auth::user()->id;
            $producto->save();
            return back()->with('updated', 'Se ha modificado el producto');
            return response()->json($producto);
        } catch (\Exception $th) {
            dd($th);
            return back()->with('error', 'No se pudo crear el registro');
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
            $producto = Product::find($id);
            $almacen = Almacen::where('product_id', $id)->get()->first();
            if ($producto->receta == '0') {
                Storage::delete($producto->path);
                $almacen->delete();
                $producto->delete();

                return back()->with('deleted', 'Se elimino correctamente el registro', $id);
            } else if ($producto->receta == '1') {
                Storage::delete($producto->path);

                $producto->ingredients()->detach();
                $producto->delete();
                return back()->with('deleted', 'Se elimino correctamente el registro', $id);
            }
        } catch (\Throwable $th) {
            $exception = $th->getMessage();
            return back()->with(['error' => 'No se pudo eliminar el registro, por favor, contacta a un administrado del sistema.', 'code' => $exception]);
        }
    }
}
