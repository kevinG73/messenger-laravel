<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Email;
use App\Models\Etudiants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function index($user_id = null)
    {
        $user_id = (int)$user_id;
        if ($user_id > 0) {

            $emails = Email::with('expediteur', 'destinataire')->where([
                'destinataire' => $user_id
            ])->get();

        } else {
            $emails = Email::with('expediteur')->get();
        }
        return response([
            'data' => $emails
        ]);
    }

    public function sendMail(Request $request)
    {
        try {
            $request->validate([
                'classe_id' => 'required',
                'objet' => 'required|min:2|max:255',
                'message' => 'required|min:2'
            ]);

            /* enregistrement dans la bd */
            $classe_id = $request->get('classe_id');
            $user_id = $request->get('user_id');

            /* liste des étudiants de la classe */
            $etudiants = Etudiants::with('classe', 'user')->where('classe_id', '=', $classe_id)->get();
            /* envoie du mail */
            $title = $request->get('objet');
            $message = $request->get('message');

            foreach ($etudiants as $etd) {
                if (isset($etd['user'])) {
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
                    $saved = $dsms->save();
                }
            }

            return response([
                'success' => true,
                'message' => 'success'
            ]);

        } catch (\Exception $ex) {

            return response([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }

    }

}
