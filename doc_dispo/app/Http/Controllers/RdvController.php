<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\Rdv;
use App\Models\Creneau;
use App\Models\Proche;
use Illuminate\Http\Request;
use App\Mail\MailRdv;
use Illuminate\Support\Facades\Mail;
use Validator;

use Session;
use DB;

class RdvController extends Controller
{
    //
    // Prise d'un rdv
    public function ajouter(Request $request)
    {
        if(Session::has('user'))
        {
            try{
                $validator = Validator::make($request->all(), [
                    'proche' => 'required',
                    'id_creneau' => 'required',
                ]);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                $rdv = new Rdv();
                $rdv->id_proche = $request->proche;
                $rdv->id_creneau = $request->id_creneau;

                $creneau = Creneau::find($request->id_creneau);
                if(is_null($creneau))
                {
                    $validator->errors()->add("id_creneau", "Veuillez bien sélectionner un créneau");
                    return back()->withErrors($validator)->withInput();
                }

                $medecin = Medecin::find($creneau->id_medecin);



                $creneau->etat = 1;
                $creneau->update();

                $rdv->save();

                $message = "Le ".$creneau->jour." à ".$creneau->heure;
                $informations = ["Rappel rendez-vous", $message];
                Mail::to(Session::get('user')->email)->send(new MailRdv($informations));
                Mail::to($medecin->email)->send(new MailRdv($informations));

                Session::put('success', 'Le rendez vous a été pris avec succès');
                return redirect()->back();
           }
            catch(\ Exception $e)
            {
                Session::put('fail', 'Une erreur s\'est produite ');
                return redirect()->back();
            }
        }
        abort(404);

    }

    // Suppression d'un rdv
    public function supprimer($id)
    {
        if(Session::has('user'))
        {
            try{

                $rdv = Rdv::where('slug', $id)->first();
                $proche = Proche::find($rdv->id_proche);

                if($proche->id_patient == Session::get('user')->id)
                {
                    $creneau = Creneau::find($rdv->id_creneau);
                    $date_creneau = $creneau->jour." ".$creneau->heure;
                    $timeStamp = strtotime($date_creneau);

                    /*
                     * Un rdv ne peut être annulé qu'au plus tard 2h avant
                     */
                    if(($timeStamp - time()) <= 2*60*60 )
                    {
                        Session::put('fail', 'Vous ne pouvez pas annuler ce Rdv');
                    }
                    else{
                        $creneau->etat = 0;
                        $creneau->update();
                        $rdv->delete();

                        Session::put('success', 'Le rendez vous a été annulé avec succès');
                    }


                    return redirect()->back();
                }

                abort(404);


            }
            catch(\ Exception $e)
            {
                Session::put('fail', 'Une erreur s\'est produite ');
                return redirect()->back();
            }
        }
        abort(404);
    }
}
