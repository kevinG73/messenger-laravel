<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $total_etudiant = User::all()->where('role_id','=',2)->count();
        $total_personnel = User::all()->where('role_id','=',1)->count();

        return view('pages.index')->with([
            'total_etudiant' => $total_etudiant,
            'total_personnel' => $total_personnel
        ]);
    }
}
