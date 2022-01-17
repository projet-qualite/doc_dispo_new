<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpecialiteHopital;
use App\Models\Specialite;
use Session;
use Validator;


class SpecialiteHopitalController extends Controller
{
    //

    // Ajouter la spécialité d'un hôpital
    public function ajouter(Request $request)
    {
        try{
            if(Session::has('hopital'))
            {
                $validator = Validator::make($request->all(),
                    [
                            'specialite' => 'required',
                    ]
                );

                if($validator->fails())
                {
                    return back()->withErrors($validator)->withInput();
                }


                $specialiteExist = SpecialiteHopital::where('id_hopital', Session::get('hopital')->id)
                                ->where('id_specialite', $request->specialite)
                                ->get()
                                ->first();
                // On vérifie que l'hôpital n'a pas déjà ajouté cette spécialité
                if(is_null($specialiteExist))
                {
                    $specialiteHopital = new SpecialiteHopital();
                    $specialiteHopital->id_hopital = Session::get('hopital')->id;
                    $specialiteHopital->id_specialite = $request->specialite;
                    $specialiteHopital->save();
                    Session::put('success', 'Spécialité ajoutée avec succès');

                    return redirect()->back();
                }
                else{
                    Session::put('fail', 'Spécialité déjà existante.');
                    return redirect()->back();
                }


            }
            abort(404);
        }
        catch(\ Exception $e)
        {
            // Renvoie un message si une exception a été lancée
            Session::put('fail', 'Une érreur s\'est produite. Veuillez saisir correctement les informations. ');
            return redirect()->back();
        }
    }


    // Supprimer une spécialité d'un hôpital
    public function supprimer($id_specialite_hopital)
    {
        try{
            if(Session::has('hopital'))
            {
                $specialiteHopital = SpecialiteHopital::find($id_specialite_hopital);
                if(Session::get('hopital')->id == $specialiteHopital->id_hopital)
                {
                    $specialiteHopital->delete();
                    Session::put('success_', 'Spécialité supprimée.');
                    return redirect()->back();
                }
                abort(404);
            }
            abort(404);

        }
        catch(\ Exception $e)
        {
            // Renvoie un message si une exception a été lancée
            Session::put('fail_', 'Une érreur s\'est produite');
            return redirect()->back();
        }
    }
}
