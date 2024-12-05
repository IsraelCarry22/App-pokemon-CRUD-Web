<?php

use App\Http\Controllers\Crud_Table_1;
use App\Http\Controllers\Crud_Table_2;
use App\Http\Controllers\Crud_Table_3;
use App\Http\Controllers\Crud_Table_4;
use App\Http\Controllers\Crud_Table_5;
use App\Http\Controllers\Crud_Table_6;
use App\Http\Controllers\Crud_Table_7;
use App\Http\Controllers\Crud_Table_8;
use App\Http\Controllers\Crud_Table_9;
use App\Http\Controllers\Crud_Table_10;
use App\Http\Controllers\CrudInicio;
use App\Http\Controllers\CrudLogin;
use Illuminate\Support\Facades\Route;

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


/* el metodo funciona de esta manera

Al entrar a la raiz del proyecto con "/" entra directamente al controlador
ene ste caso "CrudController", dentro llama al metodo "inicio"
*/

Route::get("/",[CrudLogin::class, "login"])->name("crud.login");
Route::post("/inicio-seccion",[CrudLogin::class, "inicio_seccion"])->name("crud.inicio_seccion");
Route::get("/registro",[CrudLogin::class, "registro"])->name("crud.registro");

// Ruta protegida para la página de inicio, solo accesible si el usuario está autenticado
Route::get("/inicio", [CrudInicio::class, "inicio"])->name("crud.inicio");

/* 
    Rutas para la Tabla entrenador (view)
*/
Route::get('/tabla-entrenador', [Crud_Table_1::class, 'tabla_entrenador_crud'])->name('crud.tabla_entrenador'); // Ruta para la vista de Tabla_Entrenador
Route::post('/registrar-entrenador', [Crud_Table_1::class, "create_entrenador"])->name("crud.create_entrenador");
Route::post('/modificar-entrenador', [Crud_Table_1::class, "update_entrenador"])->name("crud.update_entrenador");
Route::get('/eliminar-entrenador--{id}', [Crud_Table_1::class, "delete_entrenador"])->name("crud.delete_entrenador");


/*
    Rutas para la Tabla Pokemon (view)
*/
Route::get('/tabla-pokemon', [Crud_Table_2::class, 'tabla_pokemon_crud'])->name('crud.tabla_pokemon');
Route::post('/registrar-pokemon', [Crud_Table_2::class, "create_pokemon"])->name("crud.create_pokemon");
Route::post('/modificar-pokemon', [Crud_Table_2::class, "update_pokemon"])->name("crud.update_pokemon");
Route::get('/eliminar-pokemon--{id}', [Crud_Table_2::class, "delete_pokemon"])->name("crud.delete_pokemon");


/* 
    Rutas para la Tabla Habilida (view)
*/
Route::get('/tabla-habilidad', [Crud_Table_3::class, 'tabla_habilidad_crud'])->name('crud.tabla_habilidad');
Route::post('/registrar-habilidad', [Crud_Table_3::class, "create_habilidad"])->name("crud.create_habilidad");
Route::post('/modificar-habilidad', [Crud_Table_3::class, "update_habilidad"])->name("crud.update_habilidad");
Route::get('/eliminar-habilidad--{id}', [Crud_Table_3::class, "delete_habilidad"])->name("crud.delete_habilidad");


/* 
    Rutas para la Tabla Tipo (view)
*/
Route::get('/tabla-tipo', [Crud_Table_4::class, 'tabla_tipo_crud'])->name('crud.tabla_tipo');
Route::post('/registrar-tipo', [Crud_Table_4::class, "create_tipo"])->name("crud.create_tipo");
Route::post('/modificar-tipo', [Crud_Table_4::class, "update_tipo"])->name("crud.update_tipo");
Route::get('/eliminar-tipo--{id}', [Crud_Table_4::class, "delete_tipo"])->name("crud.delete_tipo");


/* 
    Rutas para la Tabla Ciudad (view)
*/
Route::get('/tabla-ciudad', [Crud_Table_5::class, 'tabla_ciudad_crud'])->name('crud.tabla_ciudad');
Route::post('/registrar-ciudad', [Crud_Table_5::class, "create_ciudad"])->name("crud.create_ciudad");
Route::post('/modificar-ciudad', [Crud_Table_5::class, "update_ciudad"])->name("crud.update_ciudad");
Route::get('/eliminar-ciudad--{id}', [Crud_Table_5::class, "delete_ciudad"])->name("crud.delete_ciudad");


/* 
    Rutas para la Tabla Objeto (view)
*/
Route::get('/tabla-objeto', [Crud_Table_6::class, 'tabla_objeto_crud'])->name('crud.tabla_objeto');
Route::post('/registrar-objeto', [Crud_Table_6::class, "create_objeto"])->name("crud.create_objeto");
Route::post('/modificar-objeto', [Crud_Table_6::class, "update_objeto"])->name("crud.update_objeto");
Route::get('/eliminar-objeto--{id}', [Crud_Table_6::class, "delete_objeto"])->name("crud.delete_objeto");


/* 
    Rutas para la Tabla Region (view)
*/
Route::get('/tabla-region', [Crud_Table_7::class, 'tabla_region_crud'])->name('crud.tabla_region');
Route::post('/registrar-region', [Crud_Table_7::class, "create_region"])->name("crud.create_region");
Route::post('/modificar-region', [Crud_Table_7::class, "update_region"])->name("crud.update_region");
Route::get('/eliminar-region--{id}', [Crud_Table_7::class, "delete_region"])->name("crud.delete_region");


/* 
    Rutas para la Tabla Ruta (view)
*/
Route::get('/tabla-ruta', [Crud_Table_8::class, 'tabla_ruta_crud'])->name('crud.tabla_ruta');
Route::post('/registrar-ruta', [Crud_Table_8::class, "create_ruta"])->name("crud.create_ruta");
Route::post('/modificar-ruta', [Crud_Table_8::class, "update_ruta"])->name("crud.update_ruta");
Route::get('/eliminar-ruta--{id}', [Crud_Table_8::class, "delete_ruta"])->name("crud.delete_ruta");


/*
    Rutas para la Tabla Medalla (view) 
*/
Route::get('/tabla-medalla', [Crud_Table_9::class, 'tabla_medalla_crud'])->name('crud.tabla_medalla');
Route::post('/registrar-medalla', [Crud_Table_9::class, "create_medalla"])->name("crud.create_medalla");
Route::post('/modificar-medalla', [Crud_Table_9::class, "update_medalla"])->name("crud.update_medalla");
Route::get('/eliminar-medalla--{id}', [Crud_Table_9::class, "delete_medalla"])->name("crud.delete_medalla");


/* 
    Rutas para la Tabla Clima (view)
*/
Route::get('/tabla-clima', [Crud_Table_10::class, 'tabla_clima_crud'])->name('crud.tabla_clima');
Route::post('/registrar-clima', [Crud_Table_10::class, "create_clima"])->name("crud.create_clima");
Route::post('/modificar-clima', [Crud_Table_10::class, "update_clima"])->name("crud.update_clima");
Route::get('/eliminar-clima--{id}', [Crud_Table_10::class, "delete_clima"])->name("crud.delete_clima");
