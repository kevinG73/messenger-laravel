<?php

namespace App\Http\Controllers;

use App\Helpers\Sms;
use App\Models\Classes;
use App\Models\Etudiants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SMSController extends Controller
{
    public function index()
    {
        $sms = \App\Models\Sms::with('expediteurs', 'classe','destinataire')->get();
        return view('pages.sms.history', compact('sms'));
    }

    public function create()
    {
        $classes = Classes::all();
        return view('pages.sms.create', compact('classes'));
    }

    /***
     *
     */
    public function send(Request $request)
    {
        try {
            $config = array(
                'clientId' => config('app.clientId'),
                'clientSecret' => config('app.clientSecret'),
            );
            $osms = new Sms($config);
            $data = $osms->getTokenFromConsumerKey();
            $token = array(
                'token' => $data['access_token']
            );
            $classe_id = $request->get('classe_id');
            $user_id = Auth::id();

            /* liste des étudiants de la classe */
            $etudiants = Etudiants::with('classe', 'user')->where('classe_id', '=', $classe_id)->get();


            foreach ($etudiants as $etd) {
                /* envoie du sms */
                if ($etd['user']) {
                    $dest_id = $etd['user']['id'];
                    $dest_tel = $etd['user']['tel'];
                    $message = $request->get('message');
                    $response = $osms->sendSms(
                        'tel:+2250708863719',
                        'tel:+225' . $dest_tel,
                        $message,
                        'SMI');
                    /* enregistrement dans la bd */
                    $dsms = new \App\Models\Sms();
                    $dsms->expediteur = $user_id;
                    $dsms->destinataire = $dest_id;
                    $dsms->message = $message;
                    $dsms->statut = 1;
                    $dsms->save();
                }
            }

            return redirect()->route('sms.history')
                ->with('success', 'SMS envoyé avec succès .');
        } catch (\Exception $ex) {
            return redirect()->route('sms.history')
                ->withErrors($ex->getMessage());
        }
    }


}
