<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Crud_Table_3 extends Controller
{
    public function tabla_habilidad_crud()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('crud.login');
        }

        $data=DB::select(" select * from habilidad where Status = 1 ");
        
        return view("Tabla_Habilidad")->with("datos",$data);
    }

    public function create_habilidad(Request $request){
        try {
            $idCreationUser = session('user_id');
            $SQL=DB::insert("insert into habilidad(Nombre, Descripción, IdCreationUser)values(?,?,?)", [
                $request->txtNombre,
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

    public function update_habilidad(Request $request){
        try {
            $IdEditUser = session('user_id');
            $SQL=DB::update("update habilidad set Nombre=?, Descripción=?, IdEditUser=?", [
                $request->txtNombre,
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

    public function delete_habilidad($id){
        try {
            $SQL=DB::update("update habilidad set Status = 0 where ID_Habilidad ={$id}");
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
