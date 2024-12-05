<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Crud_Table_1 extends Controller
{
    public function tabla_entrenador_crud()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('crud.login');
        }

        $data=DB::select(" select * from entrenador where Status = 1 ");
        
        return view("Tabla_Entrenador")->with("datos",$data);
    }

    public function create_entrenador(Request $request){
        try {
            $idCreationUser = session('user_id');
            $SQL=DB::insert("insert into entrenador(Nombre, ApellidoPaterno, ApellidoMaterno, Edad, Ciudad_ID, Medalla_ID, Mochila_ID, IdCreationUser)values(?,?,?,?,?,?,?,?)", [
                $request->txtNombre,
                $request->txtApellidoPaterno,
                $request->txtApellidoMaterno,
                $request->txtEdad,
                $request->txtCiudad,
                $request->txtMedalla,
                $request->txtMochila,
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

    public function update_entrenador(Request $request){
        try {
            $IdEditUser = session('user_id');
            $SQL=DB::update("update entrenador set Nombre=?, ApellidoPaterno=?, ApellidoMaterno=?, Edad=?, Ciudad_ID=?, Medalla_ID=?, Mochila_ID=?, IdEditUser=?", [
                $request->txtNombre,
                $request->txtApellidoPaterno,
                $request->txtApellidoMaterno,
                $request->txtEdad,
                $request->txtCiudad,
                $request->txtMedalla,
                $request->txtMochila,
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

    public function delete_entrenador($id){
        try {
            $SQL=DB::update("update entrenador set Status = 0 where ID_Entrenador ={$id}");
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
