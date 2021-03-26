<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class ParamController extends Controller
{
    public function index()
    {
        return view('pages.parametre.index');
    }

    public function changepassword(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id);
        $user->password = $request->get('password');
        $user->save();

        return redirect()->back()->with('success', 'mot de passe mise à jour avec succès .');
    }

    public function changemail(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id);
        $user->email = $request->get('email');
        $user->save();

        return redirect()->back()->with('success', 'Adresse mail mise à jour avec succès  .');
    }

    public function changetel(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id);
        $user->tel = $request->get('tel');
        $user->save();

        return redirect()->back()->with('success', 'Numero de téléphone mise à jour avec succès  .');
    }
}
