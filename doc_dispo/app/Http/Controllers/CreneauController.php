<?php

namespace App\Http\Controllers;

use App\Models\Creneau;
use Illuminate\Http\Request;
use Validator;
use Session;

use DB;


class CreneauController extends Controller
{
    //

    // Vue pour l'ajout d'un créneau
    public function ajouterCreneauView()
    {
        if(Session::has('medecin'))
        {
            $creneauMedecin = Creneau::where('id_medecin', Session::get('medecin')->id)
                ->where('etat', 0)
                ->whereDate('jour', '>=', date('Y-m-d'))
                ->whereTime('heure', '>=', date('H.i'))
                ->orderBy('jour', 'ASC')
                ->orderBy('heure', 'ASC')
                ->paginate(10);


            $motifs = DB::table('motif')
                            ->join('motif_consultation', 'motif_consultation.id_motif', '=', 'motif.id')
                            ->select('motif.*', 'motif_consultation.id_medecin', 'motif_consultation.id AS id_consultation')
                            ->where('motif_consultation.id_medecin', Session::get('medecin')->id)
                            ->get();



            return view('back.pages.creneau')
            ->with('motifs', $motifs)
            ->with('creneaux_m', $creneauMedecin);
        }
        abort(404);
    }


    // Ajout d'un créneau
    public function ajouter(Request $request)
    {
        try{
            if(Session::has('medecin'))
            {
                $validator = Validator::make($request->all(),
                    [
                            'heure_creneau' => 'required',
                            'date_creneau' => 'required',
                            'motif' => 'required',
                    ]
                );

                if($validator->fails())
                {
                    return back()->withErrors($validator)->withInput();
                }


                /*
                 * Ajout des crénéaux
                 * Selon le choix fait par le medecin
                 */
                if($request->heure_creneau[0] == "all")
                {
                    $heures = ["8.00", "8.30", "9.00", "9.30", "10.00", "10.30", "11.00", "11.30",
                        "12.00", "12.30", "13.00", "13.30", "14.00", "14.30", "15.00", "15.30" ,"16.00", "16.30",
                        "17.00", "17.30" ];
                    for($i = 0 ; $i < count($heures); $i++)
                    {
                        $creneau = new Creneau();
                        $creneau->id_motif_consult = ($request->motif == "all") ? 0 : $request->motif;
                        $creneau->heure = $heures[$i];
                        $creneau->jour = $request->date_creneau;
                        $creneau->id_medecin = Session::get('medecin')->id;

                        $heure_minutes = explode(".", $creneau->heure);
                        $slug = $creneau->jour.'-'.$heure_minutes[0].'-'.$heure_minutes[1].'-'.Session::get('medecin')->id;

                        $creneauExist = Creneau::where('slug', $slug)->first();

                        if(is_null($creneauExist))
                        {
                            $timeStamp = strtotime($creneau->jour." ".$creneau->heure);
                            if(time() < $timeStamp)
                            {
                                $creneau->save();
                            }

                        }

                    }
                }
                else if($request->heure_creneau[0] == "all_am")
                {
                    $heures = ["8.00", "8.30", "9.00", "9.30", "10.00", "10.30", "11.00", "11.30",
                    "12.00" ];
                    for($i = 0 ; $i < count($heures); $i++)
                    {
                        $creneau = new Creneau();
                        $creneau->id_motif_consult = ($request->motif == "all") ? 0 : $request->motif;
                        $creneau->heure = $heures[$i];
                        $creneau->jour = $request->date_creneau;
                        $creneau->id_medecin = Session::get('medecin')->id;


                        $heure_minutes = explode(".", $creneau->heure);
                        $slug = $creneau->jour.'-'.$heure_minutes[0].'-'.$heure_minutes[1].'-'.Session::get('medecin')->id;

                        $creneauExist = Creneau::where('slug', $slug)->first();
                        if(is_null($creneauExist))
                        {
                            $timeStamp = strtotime($creneau->jour." ".$creneau->heure);
                            if(time() < $timeStamp)
                            {
                                $creneau->save();
                            }

                        }

                    }
                }

                else if($request->heure_creneau[0] == "all_pm")
                {
                    $heures = ["12.30", "13.00", "13.30", "14.00", "14.30", "15.00", "15.30" ,"16.00", "16.30",
                    "17.00", "17.30" ];
                    for($i = 0 ; $i < count($heures); $i++)
                    {
                        $creneau = new Creneau();
                        $creneau->id_motif_consult = ($request->motif == "all") ? 0 : $request->motif;
                        $creneau->heure = $heures[$i];
                        $creneau->jour = $request->date_creneau;
                        $creneau->id_medecin = Session::get('medecin')->id;


                        $heure_minutes = explode(".", $creneau->heure);
                        $slug = $creneau->jour.'-'.$heure_minutes[0].'-'.$heure_minutes[1].'-'.Session::get('medecin')->id;

                        $creneauExist = Creneau::where('slug', $slug)->first();
                        if(is_null($creneauExist))
                        {
                            $timeStamp = strtotime($creneau->jour." ".$creneau->heure);
                            if(time() < $timeStamp)
                            {
                                $creneau->save();
                            }

                        }

                    }
                }
                else{
                    $heures = $request->heure_creneau;
                    for($i = 0 ; $i < count($heures); $i++)
                    {
                        $creneau = new Creneau();
                        $creneau->id_motif_consult = ($request->motif == "all") ? 0 : $request->motif;
                        $creneau->heure = $heures[$i];
                        $creneau->jour = $request->date_creneau;
                        $creneau->id_medecin = Session::get('medecin')->id;


                        $heure_minutes = explode(".", $creneau->heure);
                        $slug = $creneau->jour.'-'.$heure_minutes[0].'-'.$heure_minutes[1].'-'.Session::get('medecin')->id;

                        $creneauExist = Creneau::where('slug', $slug)->first();
                        if(is_null($creneauExist))
                        {
                            $timeStamp = strtotime($creneau->jour." ".$creneau->heure);
                            if(time() < $timeStamp)
                            {
                                $creneau->save();
                            }

                        }

                    }
                }
                Session::put('success', 'Créneau(x) ajouté(s) avec succès. Il se peut que certains créneaux qui existent déjà ou dont l\'heure et la date sont déjà passés n\'aient pas été rajoutés');
                return redirect()->back();
            }
            abort(404);
        }

        catch(\ Exception $e)
        {
            // Renvoie un message si une exception a été lancée
            Session::put('fail', 'Ajout motif échouée. Veuillez saisir correctement les informations. ');
            return redirect()->back();
        }
    }


    // Supression d'un créneau
    public function supprimer($id_creneau)
    {
        try{
            if(Session::has('medecin'))
            {
                $creneau = Creneau::find($id_creneau);
                if($creneau->id_medecin == Session::get('medecin')->id)
                {
                    $creneau->delete();
                    Session::put('success_delete', 'Créneau supprimée.');
                    return redirect()->back();
                }
                abort(404);

            }
            abort(404);

        }
        catch(\ Exception $e)
        {
            // Renvoie un message si une exception a été lancée
            Session::put('fail_delete', 'Une érreur s\'est produite');
            return redirect()->back();
        }
    }
}
