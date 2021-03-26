<?php

namespace App\Http\Controllers\API;

use App\Helpers\Sms;
use App\Http\Controllers\Controller;
use App\Models\Etudiants;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function index($user_id = null)
    {
        $user_id = (int)$user_id;
        if ($user_id > 0) {

            $sms = \App\Models\Sms::with('expediteurs')->where([
                'destinataire' => $user_id
            ])->get();

        } else {
            $sms = \App\Models\Sms::with('expediteurs')->get();
        }
        return response([
            'data' => $sms
        ]);
    }


    public function sendSMS(Request $request)
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
            $user_id = $request->get('user_id');

            /* liste des étudiants de la classe */
            $etudiants = Etudiants::with('classe', 'user')->where('classe_id', '=', $classe_id)->get();
            foreach ($etudiants as $etd) {
                if ($etd['user']) {
                    /* envoie du sms */
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

            return response([
                'message' => 'success'
            ]);

        } catch (\Exception $ex) {
            return response([
                'status' => $ex->getCode(),
                'message' => $ex->getMessage()
            ]);
        }
    }


}
