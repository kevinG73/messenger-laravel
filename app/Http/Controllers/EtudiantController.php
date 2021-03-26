<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Classes;
use App\Models\Etudiants;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EtudiantController extends Controller
{
    public function index()
    {
        $etudiants = User::with('classe')->where('role_id', '=', 2)->get();
        return view('pages.etudiants.list', compact('etudiants'));
    }

    public function create()
    {
        $classes = Classes::all();
        return view('pages.etudiants.create', compact('classes'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|min:3|max:255|string',
            'prenom' => 'required|min:3|max:255|string',
            'tel' => 'required|min:10|max:10|string|unique:users',
            'email' => 'required|min:3|max:255|email|unique:users',
        ]);

        /* creation user */
        $user = new User();
        $user->first_name = $request->get('nom');
        $user->last_name = $request->get('prenom');
        $user->tel = $request->get('tel');
        $user->email = $request->get('email');
        $user->password = bcrypt('123456');
        $user->role_id = 2;
        $user_id = $user->save();

        if ($user_id) {
            /* creation etudiant */
            $etd = new Etudiants();
            $etd->classe_id = $request->get('classe_id');
            $etd->user_id = $user['id'];
            $etd->save();
        }

        /* envoie du mail */
        $dest_email = $request->get('email');
        $title = "Création de compte sur SMI";
        $message = <<<EOF
                    Bonjour ,

                    L'administrateur de la plateforme SMI vient de créer votre compte , vous avez maintenant accès à l'application SMI .

                    Cordialement,
                    SMI TEAM
                EOF;

        Mail::to($dest_email)->send(new SendMail($title, $message));

        return redirect()->route('etudiant.index')
            ->with('success', 'Mise à jour effectuée avec succès .');

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
        $user->role_id = 2;
        $user_id = $user->save();

        if ($user_id) {
            /* creation etudiant */
            $etd = Etudiants::where('user_id', '=', $user['id'])->first();
            $etd->classe_id = $request->get('classe_id');
            $etd->save();
        }


        return redirect()->route('etudiant.index')
            ->with('success', 'Mise à jour effectuée avec succès .');
    }

    public function delete($id)
    {
        /* suppresion de l'utilisateur */
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
        /* suppresion du l'étudiant */
        $etd = Etudiants::where('user_id', '=', $id)->first();
        if ($etd) {
            $etd->delete();
        }

        return redirect()->route('etudiant.index')
            ->with('success', 'suppression effectuée avec succès .');
    }
}
