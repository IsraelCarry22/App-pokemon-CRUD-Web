<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Crud_Table_6 extends Controller
{
    public function tabla_objeto_crud()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('crud.login');
        }
        
        $data=DB::select(" select * from objeto where Status = 1 ");
        
        return view("Tabla_Objeto")->with("datos",$data);
    }

    public function create_objeto(Request $request){
        try {
            $idCreationUser = session('user_id');
            $SQL=DB::insert("insert into objeto(Nombre, Región_ID, Gimasion_ID, Descripción, IdCreationUser)values(?,?,?,?,?)", [
                $request->txtNombre,
                $request->txtDescripcion,
                $request->txtRegion,
                $request->txtGimnasio,
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

    public function update_objeto(Request $request){
        try {
            $IdEditUser = session('user_id');
            $SQL=DB::update("update objeto set Nombre=?, Región_ID=?, Gimasion_ID=?, Descripción=?, IdEditUser=?", [
                $request->txtNombre,
                $request->txtDescripcion,
                $request->txtRegion,
                $request->txtGimnasio,
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

    public function delete_objeto($id){
        try {
            $SQL=DB::update("update objeto set Status = 0 where ID_Objeto ={$id}");
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
