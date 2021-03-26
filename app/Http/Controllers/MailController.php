<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Classes;
use App\Models\Email;
use App\Models\Etudiants;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        $mail = Email::with('etudiant.user', 'expediteur')->get();
        return view('pages.email.history', compact('mail'));
    }

    public function create()
    {
        $classes = Classes::all();
        return view('pages.email.create', compact('classes'));
    }

    public function send(Request $request)
    {
        try {
            $request->validate([
                'classe_id' => 'required',
                'objet' => 'required|min:3|max:255',
                'message' => 'required|min:10'
            ]);

            /* enregistrement dans la bd */
            $classe_id = $request->get('classe_id');
            $user_id = Auth::id();

            /* liste des étudiants de la classe */
            $etudiants = Etudiants::with('classe', 'user')->where('classe_id', '=', $classe_id)->get();
            /* envoie du mail */
            $title = $request->get('objet');
            $message = $request->get('message');

            foreach ($etudiants as $etd) {
                /* envoie du mail */
                $dest_id = $etd['user']['id'];
                $dest_email = $etd['user']['email'];
                Mail::to($dest_email)->send(new SendMail($title, $message));

                /* enregistrement dans la bd */
                $dsms = new Email();
                $dsms->objet = $title;
                $dsms->expediteur = $user_id;
                $dsms->destinataire = $dest_id;
                $dsms->message = $message;
                $dsms->save();
            }

            return redirect()->route('mail.history')
                ->with('success', 'Email envoyé avec succès .');

        } catch (\Exception $ex) {
            return redirect()->back()
                ->withInput()
                ->with('error', $ex->getMessage());
        }

    }

}
