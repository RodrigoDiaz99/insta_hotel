<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\Product;
use App\Models\ProductFamily;
use App\Models\Seguimiento;
use App\Models\User;

class ApiController extends Controller
{
    public function getUsers()
    {
        $usuarios = User::select('id', 'name', 'email', 'phone')->get();
        return $usuarios;
    }
    public function getComanda()
    {
        $comanda = Comanda::select('comandas.id', 'comandas.llave_comanda', 'comandas.estatus', 'tipo_dispositivos.tipo_dispositivo', 'rooms.name')
            ->join('tipo_dispositivos', 'comandas.tipo_dispositivo_id', '=', 'tipo_dispositivos.id')

            ->join('rooms', 'comandas.rooms_id', '=', 'rooms.id')

            ->get();
        return $comanda;

    }
    public function getSeguimiento()
    {
        $seguimiento = Seguimiento::select('products.name', 'seguimientos.estatus')
            ->join('products', 'seguimientos.products_id', '=', 'products.id')
            ->get();
        return $seguimiento;
    }
    // public function getProductos()
    // {
    //     $productos = Product::select('products.name', 'products.description', 'products.path', 'products.receta', 'product_families.name')
    //         ->join('product_families', 'products.product_families_id', '=', 'product_families.id')
    //         ->get();
    //     return $productos;
    // }
    public function getProductos()
    {
        $establishments = 2;
        $newfamily = [];
        $family = ProductFamily::select('id','name')
                ->where('establishments_id','=', $establishments)
                ->orderBy('id', 'asc')->get();

        foreach ($family as $i => $value) {
            // print( $value);
            $productos = Product::select('products.id','products.name as title', 'products.description', 'products.path', 'products.receta', 'product_inventories.sale_price as price',  'product_families.name as category')
            ->where('product_families.establishments_id','=', $establishments)
            ->where('product_families.name','=', $value->name)
            ->join('product_families', 'products.product_families_id', '=', 'product_families.id')
            ->join('product_inventories', 'product_inventories.products_id', '=', 'products.id')
            ->orderby('product_families.name')
            ->get();

            $productos = json_encode($productos);

            array_push($newfamily,array('clave' =>$value->name , 'producto' => $productos));
            // print_r($newfamily);
            // arraypush($newfamily, $productos);
        }
        return json_encode($newfamily);
    }

    public function getFamiliaProductos()
    {
        $familia = ProductFamily::select('id','name')
                ->where('establishments_id','=', '2')
                ->orderBy('id', 'asc')->get();
        return $familia;
    }

    // public function getFamiliaProductos()
    // {
    //     $familia = ProductFamily::orderBy('id', 'asc')->get();
    //     return $familia;
    // }
}
