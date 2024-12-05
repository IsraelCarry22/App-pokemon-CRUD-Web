<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Crud_Table_2 extends Controller
{
    public function tabla_pokemon_crud()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('crud.login');
        }

        $data=DB::select(" select * from pokémon where Status = 1 ");
        
        return view("Tabla_Pokemon")->with("datos",$data);
    }

    //Metodo para crear un registro de entrenador
    public function create_pokemon(Request $request){
        try {
            $idCreationUser = session('user_id');
            $SQL=DB::insert("insert into pokémon(Nombre, Especie_ID, Nivel, Estado_ID, Entrenador_ID, Habilidad_ID, EquipoVillano_ID, Huevo_ID, IdCreationUser)values(?,?,?,?,?,?,?,?,?)", [
                $request->txtNombre,
                $request->txtEspecie,
                $request->txtNivel,
                $request->txtEstado,
                $request->txtEntrenador,
                $request->txtHabilidad,
                $request->txtEquipoVillano,
                $request->txtHuevo,
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

    //Metodo para modificar un registro de entrenador
    public function update_pokemon(Request $request){
        try {
            $IdEditUser = session('user_id');
            $SQL=DB::update("update pokémon set Nombre=?, Especie_ID=?, Nivel=?, Estado_ID=?, Entrenador_ID=?, Habilidad_ID=?, EquipoVillano_ID=?, Huevo_ID=?, IdEditUser=?", [
                $request->txtNombre,
                $request->txtEspecie,
                $request->txtNivel,
                $request->txtEstado,
                $request->txtEntrenador,
                $request->txtHabilidad,
                $request->txtEquipoVillano,
                $request->txtHuevo,
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

    public function delete_pokemon($id){
        try {
            $SQL=DB::update("update pokémon set Status = 0 where ID_Pokémon ={$id}");
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
