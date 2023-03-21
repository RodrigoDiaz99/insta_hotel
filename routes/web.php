<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('front');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    return redirect()->route('front');
});

/* Rutas de sesión sin iniciar */
Route::get('establecimientos', [EstablishmentController::class, 'listEstablishments'])->name('establecimientos');
Route::get('establecimiento/{establishment_id}/habitaciones', [RoomController::class, 'listRoomForGuest'])->name('habitaciones');
Route::get('establecimiento/{establishment_id}/habitaciones', [RoomController::class, 'listRoomForGuest'])->name('habitaciones');


Route::controller('ReservacionController')->group(function () {
    Route::post('/reservacion/buscar', 'buscar')->name('buscar.reservacion');
    Route::get('reservacion/{reservacion_id}', 'ver')->name('ver.reservacion');
    Route::get('realizar_reservacion/{room_id}', 'crearReservacion')->name('crear.reservacion');
    Route::post('realizar_reservacion/', 'store_guest')->name('crear.reservacion.guest');
    Route::post('realizar_reservacion/registrar', 'store_guest_register')->name('crear.reservacion.guest.register');

    Route::get('buscar_cliente', 'buscar_cliente')->name('buscar.cliente');
    Route::post('reservacion/actualizar', 'update')->name('actualizar.reservacion');
    Route::post('reservacion/cancelar', 'cancelar')->name('cancelar.reservacion');
});
/* Rutas de sesión sin iniciar */
Auth::routes();


Route::group(['middleware' => 'auth'], function () {
});

/* Rutas de administrador */
Route::group(['middleware' => 'auth', 'middleware' => 'role:Super-Admin'], function () {
    Route::get('/dashboard', [function () {
        return view('dashboard');
    }])->name('dashboard');

    /**
     * Establisment Routes
     */
    Route::resource('establishments', 'EstablishmentController')->only('index', 'create', 'edit', 'store');
    Route::resource('establishment-areas', 'EstablishmentAreaController')->only('index', 'create', 'edit');
    Route::resource('establishments.room-areas', 'RoomAreasController')->only('index', 'create', 'edit');
    Route::put('establishment/area/update/{id}','RoomAreasController@update')->name('room_area.update');
    Route::get('establishment/area/delete/{id}','RoomAreasController@destroy')->name('room_area.delete');
    Route::resource('establishments.rooms', 'RoomController')->only('index', 'create', 'edit');
    Route::delete('/rooms/delete/{id}', 'RoomController@destroy')->name('room.delete');
    Route::put('/rooms/update/{id}', 'RoomController@update')->name('room.update');
    Route::resource('establishments.rooms.shellies', 'ShellyController')->only('index', 'create', 'edit');

    /**
     * Clients Routes
     */
    Route::controller('ClientesController')->group(function () {
        Route::get('/clientes/index', 'index')->middleware('role:Super-Admin')->name('clientes.index');
        Route::get('/clientes/create', 'create')->name('clientes.create');
        Route::post('/clientes/store', 'store')->name('clientes.store');
        Route::get('/clientes/{id}/edit', 'edit')->name('clientes.edit');
        Route::put('/clientes/{id}', 'update')->name('clientes.update');
        Route::get('/cientes/{id}', 'delete')->name('clientes.delete');
    });

    Route::controller('RoomController')->group(function () {
        Route::get('/rooms/{establishment_id}/', 'index')->name('rooms.index');
        Route::post('/rooms/{establishment_id}/store', 'store')->name('room.store');
        Route::get('/rooms/{establishment_id}/create', 'create')->name('room.create');
        Route::post('/room/status/', 'status')->name('room.status');
    });

    Route::controller('TiposHabitacion')->group(function () {
        Route::get('/tipos_habitacion/{establishment_id}', 'index')->name('tiposhabitacion.index');
        Route::post('/tipos_habitacion/agregar', 'store')->name('tiposhabitacion.store');
        Route::post('/tipos_habitacion/editar', 'update')->name('tiposhabitacion.update');
        Route::post('/tipos_habitacion/eliminar', 'delete')->name('tiposhabitacion.delete');
    });

    Route::controller('EstablishmentAreaController')->group(function () {
        Route::get('/areas/{establishment_id}/', 'index')->name('areas.index');
        Route::post('/areas/{establishment_id}/store', 'store')->name('areas.store');
        Route::get('/areas/{establishment_id}/create', 'create')->name('areas.create');
    });

    Route::controller('RoomAreasController')->group(function () {
        Route::get('/rooms_areas/{establishment_id}/', 'index')->name('room_areas.index');
        Route::post('/rooms_areas/{establishment_id}/store', 'store')->name('room_area.store');
        Route::get('/rooms_areas/{establishment_id}/create', 'create')->name('room_area.create');
    });


    /**
     * Incidents Routes
     */
    Route::controller('IncidentesController')->group(function () {
        Route::get('/incidentes/index', 'index')->name('incidentes.index');
        Route::post('/incidentes/store', 'store')->name('incidentes.store');
        Route::put('/incidentes/{id}', 'update')->name('incidentes.update');
        Route::get('/incidentes/{id}', 'delete')->name('incidentes.delete');
    });

    /**
     * Inventory Routes
     */
    Route::controller('InventoryController')->group(function () {
        Route::get('/inventory/index', 'index')->name('inventory.index');
        Route::post('/inventory', 'store')->name('inventory.store');
        Route::get('/inventory/create', 'create')->name('inventory.create');
        Route::get('/inventory/{id}', 'show')->name('inventory.show');
        Route::put('/inventory/{id}', 'update')->name('inventory.update');
        Route::delete('/inventory/{id}', 'destroy')->name('inventory.delete');
        Route::get('/inventory/{id}/edit', 'edit')->name('inventory.edit');
        Route::post('/inventory/table', 'getInventario')->name('inventory.getInventario');
    });

    /**
     * Stretche Routes
     */
    Route::controller('StretchController')->group(function () {
        Route::get('/stretch/index', 'index')->name('stretch.index');
        Route::post('/stretch', 'store')->name('stretch.store');
        Route::get('/stretch/create', 'create')->name('stretch.create');
        Route::get('/stretch/{id}', 'show')->name('stretch.show');
        Route::put('/stretch/{id}', 'update')->name('stretch.update');
        Route::delete('/stretch/{id}', 'delete')->name('stretch.delete');
        Route::get('/stretch/{id}/edit', 'edit')->name('stretch.edit');
    });

    /**
     * Reservation Desk Routes
     */
    Route::controller('ReservationDeskController')->group(function () {
        Route::get('/reservationDesk/index', 'index')->name('ReservationDesk.index');
        Route::post('/reservationDesk', 'store')->name('ReservationDesk.store');
        Route::get('/reservationDesk/create', 'create')->name('ReservationDesk.create');
        Route::get('/reservationDesk/{id}', 'show')->name('ReservationDesk.show');
        Route::put('/reservationDesk/{id}', 'update')->name('ReservationDesk.update');
        Route::delete('/reservationDesk/{id}', 'delete')->name('ReservationDesk.delete');
        Route::get('/reservationDesk/{id}/edit', 'edit')->name('ReservationDesk.edit');
    });
    /**
     * Product Routes
     */
    Route::controller('ProductController')->group(function () {

        Route::get('/product/{establishment_id}/', 'index')->name('product.index');
        Route::get('/product/list/{establishment_id}/', 'gridProductos')->name('product.list');
        Route::post('/product/{establishment_id}/store', 'store')->name('product.store');
        Route::get('/product/{establishment_id}/create', 'create')->name('product.create');
        Route::put('/product/update/product/', 'update')->name('product.update');
        Route::delete('/product/{id}/destroy', 'destroy')->name('product.delete');
        Route::get('/product/edit/id', 'edit')->name('product.edit');

        Route::post('/{establishment_id}/productRecipe', 'storeRecipe')->name('product.storeRecipe');
    });

    Route::controller('ProductFamilyController')->group(function () {
        Route::get('/product_family/{establishment_id}/', 'index')->name('tipo.index');
        Route::post('/create/family/{establishment_id}/', 'store')->name('tipo.store');
        Route::put('/update/family/{id}', 'update')->name('tipo.update');
        Route::delete('/delete/family/{id}', 'destroy')->name('tipo.delete');
    });

    Route::controller('IngredientController')->group(function () {
        Route::get('/ingredientes/{establishment_id}/', 'index')->name('ingredient.index');
        Route::post('/ingredientes/{establishment_id}/store', 'store')->name('ingredient.store');
        Route::put('/ingredientes/{id}/update', 'update')->name('ingredient.update');
        Route::delete('/ingredientes/{id}/destroy', 'destroy')->name('ingredient.delete');
    });

    Route::controller('ComprasController')->group(function () {
        Route::get('/compras/{establishment_id}/', 'index')->name('compras.index');
        Route::get('/compras/detalles/{compra_id}', 'show')->name('compras.detalles');
        Route::get('/compras/{establishment_id}/create/', 'create')->name('compras.create');
        Route::post('/compras/{establishment_id}/store', 'store')->name('compras.store');
        Route::put('/compras/{id}/update', 'update')->name('compras.update');
        Route::delete('/compras/{id}/destroy', 'destroy')->name('compras.delete');
        Route::get('/compras/{compra_id}/cancel', 'cancel')->name('compras.cancel');
    });

    Route::controller('VentaController')->group(function(){
        Route::get('/ventas/{establishment_id}/','index')->name('ventas.index');
        Route::get('/ventas/ticket/{venta_id}/','ticket')->name('ventas.ticket');
        Route::get('/ventas/detalles/{venta_id}/', 'show')->name('ventas.detalles');
        Route::get('/ventas/{establishment_id}/create/', 'create')->name('ventas.create');
        Route::post('/ventas/{establishment_id}/store', 'store')->name('ventas.store');
        Route::put('/ventas/{id}/update', 'update')->name('ventas.update');
        Route::get('/ventas/{venta_id}/cancel', 'cancel')->name('ventas.cancel');
    });

    Route::controller('ProveedoresController')->group(function () {
        Route::get('/proveedores/{establishment_id}/', 'index')->name('proveedores.index');
        Route::get('/proveedores/detalles/{compra_id}', 'show')->name('proveedores.detalles');
        Route::get('/proveedores/{establishment_id}/create/', 'create')->name('proveedores.create');
        Route::post('/proveedores/{establishment_id}/store', 'store')->name('proveedores.store');
        Route::put('/proveedores/{id}/update', 'update')->name('proveedores.update');
        Route::delete('/proveedores/{id}/destroy', 'destroy')->name('proveedores.delete');
        Route::get('/proveedores/{compra_id}/cancel', 'cancel')->name('proveedores.cancel');
    });

    Route::controller('AlmacenController')->group(function () {
        Route::get('/almacen/{establishment_id}/', 'index')->name('almacen.index');
        Route::get('/almacen/detalles/{compra_id}', 'show')->name('almacen.detalles');
        Route::get('/almacen/{establishment_id}/create/', 'create')->name('almacen.create');
        Route::post('/almacen/{establishment_id}/store', 'store')->name('almacen.store');
        Route::put('/almacen/{id}/update', 'update')->name('almacen.update');
        Route::delete('/almacen/{id}/destroy', 'destroy')->name('almacen.delete');
        Route::get('/almacen/{compra_id}/cancel', 'cancel')->name('almacen.cancel');
    });

    Route::controller('TramoController')->group(function () {
        Route::get('/tramo/{establishment_id}/', 'index')->name('tramo.index');
        Route::get('/tramo/list/', 'gridTramos')->name('tramo.list');
        Route::get('/tramo/{establishment_id}/create/', 'create')->name('tramo.create');
        Route::post('/tramo/{establishment_id}/store', 'store')->name('tramo.store');
        Route::put('/tramo/{id}/update', 'update')->name('tramo.update');
        Route::delete('/tramo/{id}/destroy', 'destroy')->name('tramo.delete');
        //   Route::get('/tramo/{compra_id}/cancel', 'cancel')->name('almacen.cancel');
    });
    Route::controller('TarifaController')->group(function () {
        Route::get('/tarifa/{establishment_id}/', 'index')->name('tarifa.index');
        Route::get('/tarifa/{establishment_id}/create/', 'create')->name('tarifa.create');
        Route::post('/tarifa/{establishment_id}/store', 'store')->name('tarifa.store');
        Route::put('/tarifa/{id}/update', 'update')->name('tarifa.update');
        Route::delete('/tarifa/{id}/destroy', 'destroy')->name('tarifa.delete');
        //   Route::get('/tramo/{compra_id}/cancel', 'cancel')->name('almacen.cancel');
    });

    Route::controller('ComandaController')->group(function () {
        Route::get('/comanda/{establishment_id}/', 'index')->name('comanda.index');

        Route::get('/comanda/{establishment_id}/create/', 'create')->name('comanda.create');
        Route::post('/comanda/{establishment_id}/store', 'store')->name('comanda.store');
        Route::put('/comanda/{id}/update', 'update')->name('comanda.update');
        Route::delete('/comanda/{id}/destroy', 'destroy')->name('comanda.delete');
        Route::post('/comanda/getComandas', 'getComandas')->name('comandas.get');
        //   Route::get('/tramo/{compra_id}/cancel', 'cancel')->name('almacen.cancel');
    });
    Route::controller('DepartamentoController')->group(function () {
        Route::get('/departamento/{establishment_id}/', 'index')->name('departamento.index');

        Route::get('/departamento/{establishment_id}/create/', 'create')->name('departamento.create');
        Route::post('/departamento/{establishment_id}/store', 'store')->name('departamento.store');
        Route::put('/departamento/{id}/update', 'update')->name('departamento.update');
        Route::delete('/departamento/{id}/destroy', 'destroy')->name('departamento.delete');
        //   Route::get('/tramo/{compra_id}/cancel', 'cancel')->name('almacen.cancel');
    });
    Route::controller('SeguimientoController')->group(function () {
        Route::get('/pedido/{establishment_id}/', 'index')->name('pedido.index');

        Route::get('/seguimiento/{establishment_id}/create/', 'create')->name('seguimiento.create');
        Route::post('/seguimiento/{establishment_id}/store', 'store')->name('seguimiento.store');
        Route::put('/seguimiento/{id}/update', 'update')->name('seguimiento.update');
        Route::delete('/seguimiento/{id}/destroy', 'destroy')->name('seguimiento.delete');
        Route::post('/pedido/seguimiento', 'seguimiento')->name('pedido.seguimiento');
    });
    Route::controller('PedidoController')->group(function () {
        Route::get('/pedido/{establishment_id}/', 'index')->name('pedido.index');

        Route::get('/pedido/{establishment_id}/create/', 'create')->name('pedido.create');
        Route::post('/pedido/{establishment_id}/store', 'store')->name('pedido.store');
        Route::put('/pedido/{id}/update', 'update')->name('pedido.update');
        Route::delete('/pedido/{id}/destroy', 'destroy')->name('pedido.delete');

        //   Route::get('/tramo/{compra_id}/cancel', 'cancel')->name('almacen.cancel');
    });
    Route::resource('category', 'CategoryController', ['except' => ['show']]);
    Route::resource('tag', 'TagController', ['except' => ['show']]);
    Route::resource('item', 'ItemController', ['except' => ['show']]);
    Route::resource('role', 'RoleController', ['except' => ['show', 'destroy']]);
    Route::resource('user', 'UserController', ['except' => ['show']]);

    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    /**
     * Product Routes
     */
    Route::controller('ReservacionController')->group(function () {

        Route::get('/reservaciones/{establishment_id}', 'index')->name('reservaciones.index');
        Route::get('/reservar/{room_id}/', 'create')->name('reservaciones.create');
        Route::post('/reservar/realizar_reservacion/', 'store')->name('reservaciones.store');

        /* Ruta de usuario */
        Route::get('/realizar_reservacion/habitaciones', 'habitaciones')->name('reserva.habitaciones');
    });
});
