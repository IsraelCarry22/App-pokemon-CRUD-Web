<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Crud_Table_8 extends Controller
{
    public function tabla_ruta_crud()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('crud.login');
        }
        
        $data=DB::select(" select * from ruta where Status = 1 ");
        
        return view("Tabla_Ruta")->with("datos",$data);
    }

    public function create_ruta(Request $request){
        try {
            $idCreationUser = session('user_id');
            $SQL=DB::insert("insert into ruta(Nombre, Ciudad_Inicio_ID, Ciudad_Fin_ID, Descripción, IdCreationUser)values(?,?,?,?,?)", [
                $request->txtNombre,
                $request->txtCiudadInicio,
                $request->txtCiudadFin,
                $request->txtDescripcion,
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

    public function update_ruta(Request $request){
        try {
            $IdEditUser = session('user_id');
            $SQL=DB::update("update ruta set Nombre=?, Ciudad_Inicio_ID=?, Ciudad_Fin_ID=?, Descripción=?, IdEditUser=?", [
                $request->txtNombre,
                $request->txtCiudadInicio,
                $request->txtCiudadFin,
                $request->txtDescripcion,
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

    public function delete_ruta($id){
        try {
            $SQL=DB::update("update ruta set Status = 0 where ID_Ruta ={$id}");
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
