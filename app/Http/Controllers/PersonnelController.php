<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function index()
    {
        $personnels = User::all()->where('role_id', '=', 1);
        return view('pages.personnels.list', compact('personnels'));
    }

    public function create()
    {
        return view('pages.personnels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|min:3|max:255|string',
            'prenom' => 'required|min:3|max:255|string',
            'tel' => 'required|min:10|max:10|string|unique:users',
            'email' => 'required|min:3|max:255|string|unique:users',
        ]);

        /* creation user */
        $user = new User();
        $user->first_name = $request->get('nom');
        $user->last_name = $request->get('prenom');
        $user->tel = $request->get('tel');
        $user->email = $request->get('email');
        $user->password = bcrypt('123456');
        $user->role_id = 1;
        $user_id = $user->save();

        return redirect()->route('personnel.index')
            ->with('success', 'Mise à jour effectuée avec succès .');
    }

    public function edit($id)
    {
        $personnel = User::find($id);
        return view('pages.personnels.edit')->with([
            'user' => $personnel
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|min:3|max:255|string',
            'prenom' => 'required|min:3|max:255|string',
            'tel' => 'required|min:10|max:10|string',
            'email' => 'required|min:3|max:255|string',
        ]);

        /* creation user */
        $user = User::find($id);
        $user->first_name = $request->get('nom');
        $user->last_name = $request->get('prenom');
        $user->tel = $request->get('tel');
        $user->email = $request->get('email');
        $user->password = bcrypt('123456');
        $user->role_id = 1;
        $user->save();

        return redirect()->route('personnel.index')
            ->with('success', 'Mise à jour effectuée avec succès .');
    }

}
