<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Crud_Table_7 extends Controller
{
    public function tabla_region_crud()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('crud.login');
        }
        
        $data=DB::select(" select * from region where Status = 1 ");
        
        return view("Tabla_Region")->with("datos",$data);
    }

    public function create_region(Request $request){
        try {
            $idCreationUser = session('user_id');
            $SQL=DB::insert("insert into region(Nombre, Descripción, Ruta_ID, PokemónRegional_ID, IdCreationUser)values(?,?,?,?,?)", [
                $request->txtNombre,
                $request->txtDescripcion,
                $request->txtRuta,
                $request->txtPokemonReg,
                $idCreationUser 
            ]);
        } catch (\Throwable $th) {
            $SQL = 0;
        }
        if ($SQL == true) {
            return back()->with("Correcto","Los datos fueron insertados correctamente.");
        } else {
            return back()->with("Incorrecto","Error al insertar datos (datos vacios o datos invalidos).");
        }
    }

    public function update_region(Request $request){
        try {
            $IdEditUser = session('user_id');
            $SQL=DB::update("update region set Nombre=?, Descripción=?, Ruta_ID=?, PokemónRegional_ID=?, IdEditUser=?", [
                $request->txtNombre,
                $request->txtDescripcion,
                $request->txtRuta,
                $request->txtPokemonReg,
                $IdEditUser
            ]);
            if($SQL==0){
                $SQL=1;
            }
        } catch (\Throwable $th) {
            $SQL = 0;
        }
        if ($SQL == true) {
            return back()->with("Correcto","Los datos fueron modificados correctamente.");
        } else {
            return back()->with("Incorrecto","Error al modificar los datos (datos vacios o datos invalidos).");
        }
    }

    public function delete_region($id){
        try {
            $SQL=DB::update("update region set Status = 0 where ID_Region ={$id}");
            if($SQL==0){
                $SQL=1;
            }
        } catch (\Throwable $th) {
            $SQL = 0;
        }
        if ($SQL == true) {
            return back()->with("Correcto","El registro fue eliminado correctamente.");
        } else {
            return back()->with("Incorrecto","Error al eliminar el registro.");
        }
    }
}
