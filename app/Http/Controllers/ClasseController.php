<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function index()
    {
        $classes = Classes::all();
        return view('pages.classes.list', compact('classes'));
    }

    public function create()
    {
        return view('pages.classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|min:3|max:255|string'
        ]);

        Classes::create($request->all());

        return redirect()->route('classe.index')
            ->with('success', 'Mise à jour effectuée avec succès .');
    }

    public function edit($id)
    {
        $classes = Classes::find($id);
        return view('pages.classes.edit', compact('classes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|min:2|max:255'
        ]);

        $classe = Classes::find($id);
        $classe->nom = $request->get('nom');
        $classe->save();

        return redirect()->route('classe.index')
            ->with('success', 'Mise à jour effectuée avec succès .');
    }

    public function delete($id)
    {
        $classes = Classes::find($id);
        $classes->delete();

        return redirect()->route('classe.index')
            ->with('success', 'suppression effectuée avec succès .');
    }
}
