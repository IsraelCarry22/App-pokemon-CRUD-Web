<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Crud_Table_10 extends Controller
{
    public function tabla_clima_crud()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('crud.login');
        }
        
        $data=DB::select(" select * from clima where Status = 1 ");
        
        return view("Tabla_Clima")->with("datos",$data);
    }

    public function create_clima(Request $request){
        try {
            $idCreationUser = session('user_id');
            $SQL=DB::insert("insert into clima(Nombre, Descripción, Region_ID, IdCreationUser)values(?,?,?,?)", [
                $request->txtNombre,
                $request->txtDescripcion,
                $request->txtRegion,
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

    public function update_clima(Request $request){
        try {
            $IdEditUser = session('user_id');
            $SQL=DB::update("update clima set Nombre=?, Descripción=?, Region_ID=?, IdEditUser=?", [
                $request->txtNombre,
                $request->txtDescripcion,
                $request->txtRegion,
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

    public function delete_clima($id){
        try {
            $SQL=DB::update("update clima set Status = 0 where ID_Clima ={$id}");
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
