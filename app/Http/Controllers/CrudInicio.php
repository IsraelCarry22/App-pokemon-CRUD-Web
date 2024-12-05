<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrudInicio extends Controller
{
    public function inicio()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('crud.login');
        }
        return view('inicio', compact('userId'));
    }
}
