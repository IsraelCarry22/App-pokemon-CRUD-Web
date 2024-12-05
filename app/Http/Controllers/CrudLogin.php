<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CrudLogin extends Controller
{
    public function login()
    {
        return view("login");
    }

    public function inicio_seccion(Request $request)
    {
        try {
            // Buscar al usuario por el username (si existe)
            $user = DB::table('user')->where('Username', $request->txtUser)->first();

            // Verificar si el usuario existe y si la contraseña es correcta
            if ($user && Hash::check($request->txtPasw, $user->Password)) {
                session(['user_id' => $user->Id]);
                return redirect()->route('crud.inicio');
            } else {
                // Si no es correcto, mostrar un mensaje de error
                return back()->with('Incorrecto', 'Usuario o contraseña incorrectos');
            }
        } catch (\Exception $e) {
            // Manejar errores
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function registro(Request $request){
        try {
            $SQL=DB::insert("insert into user (Username, Password, IdCreationUser, CreateDate)values(?,?,1, NOW())", [
                $request->txtUser,
                Hash::make($request->txtPasw),
            ]);
            if($SQL==0){
                $SQL=1;
            }
        }
        catch (\Exception $e) {
            $SQL = 0;
        }
        
        if($SQL == true){
            // Redirigir al usuario después del registro
            return redirect()->route('crud.login')->with('Correcto', 'Usuario registrado exitosamente.');
        }
        else{
            return back()->with("Incorrecto","Error al insertar datos (datos vacios o datos invalidos).");
        }
    }
}
