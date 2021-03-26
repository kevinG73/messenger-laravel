<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Etudiants;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EtudiantController extends Controller
{
    public function index()
    {
        $etudiants = User::with('classe')->where('role_id', '=', 2)->get();
        return response([
            'data' => $etudiants
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nom' => 'required|min:3|max:255|string',
                'prenom' => 'required|min:3|max:255|string',
                'tel' => 'required|string|unique:users',
                'email' => 'required|min:3|max:255|string|unique:users',
            ]);

            if ($validator->fails()) {
                return response([
                    'error' => true,
                    'message' => $validator->errors()
                ]);
            }
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

            return response([
                'error' => false,
                'message' => 'Mise à jour effectuée avec succès .'
            ]);

        } catch (\Exception $ex) {
            return response([
                'data' => '',
                'message' => $ex->getMessage()
            ]);
        }
    }
}
