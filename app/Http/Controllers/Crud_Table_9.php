<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Crud_Table_9 extends Controller
{
    public function tabla_medalla_crud()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('crud.login');
        }
        
        $data=DB::select(" select * from medalla where Status = 1 ");
        
        return view("Tabla_Medalla")->with("datos",$data);
    }

    public function create_medalla(Request $request){
        try {
            $idCreationUser = session('user_id');
            $SQL=DB::insert("insert into medalla(Nombre, Descripción, LiderGYM_ID, IdCreationUser)values(?,?,?,?)", [
                $request->txtNombre,
                $request->txtDescripcion,
                $request->txtLiderGYM,
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

    public function update_medalla(Request $request){
        try {
            $IdEditUser = session('user_id');
            $SQL=DB::update("update medalla set Nombre=?, Descripción=?, LiderGYM_ID=?, IdEditUser=?", [
                $request->txtNombre,
                $request->txtDescripcion,
                $request->txtLiderGYM,
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

    public function delete_medalla($id){
        try {
            $SQL=DB::update("update medalla set Status = 0 where ID_Medalla ={$id}");
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
