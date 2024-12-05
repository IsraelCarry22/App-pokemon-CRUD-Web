<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Crud_Table_4 extends Controller
{
    public function tabla_tipo_crud()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('crud.login');
        }
        
        $data=DB::select(" select * from tipo where Status = 1 ");
        
        return view("Tabla_Tipo")->with("datos",$data);
    }

    public function create_tipo(Request $request){
        try {
            $idCreationUser = session('user_id');
            $SQL=DB::insert("insert into tipo(Nombre, Descripción, IdCreationUser)values(?,?,?)", [
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

    public function update_tipo(Request $request){
        try {
            $IdEditUser = session('user_id');
            $SQL=DB::update("update tipo set Nombre=?, Descripción=?, IdEditUser=?", [
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

    public function delete_tipo($id){
        try {
            $SQL=DB::update("update tipo set Status = 0 where ID_Tipo ={$id}");
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
