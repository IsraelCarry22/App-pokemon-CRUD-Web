<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Crud_Table_5 extends Controller
{
    public function tabla_ciudad_crud()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('crud.login');
        }
        
        $data=DB::select(" select * from ciudad where Status = 1 ");
        
        return view("Tabla_Ciudad")->with("datos",$data);
    }

    public function create_ciudad(Request $request){
        try {
            $idCreationUser = session('user_id');
            $SQL=DB::insert("insert into ciudad(Nombre, Región_ID, Gimasion_ID, Descripción, IdCreationUser)values(?,?,?,?,?)", [
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

    public function update_ciudad(Request $request){
        try {
            $IdEditUser = session('user_id');
            $SQL=DB::update("update ciudad set Nombre=?, Región_ID=?, Gimasion_ID=?, Descripción=?, IdEditUser=?", [
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

    public function delete_ciudad($id){
        try {
            $SQL=DB::update("update ciudad set Status = 0 where ID_Ciudad ={$id}");
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
