<?php

namespace App\Http\Controllers;

use App\Models\Partie;
use Illuminate\Http\Request;

use Session;
use Validator;

class PartieController extends Controller
{
    public function ajouter(Request $request)
    {
        try{
            if(Session::has('admin'))
            {
                $validator = Validator::make($request->all(), [
                    'nom' => 'required',
                ]);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }


                $partie = new Partie();

                $partie->nom = $request->nom;

                $partie->save();

                Session::put('success', 'Partie enregistrée avec succès');

                return redirect()->back();
            }
            abort(404);
        }
        catch(\ Exception $e)
        {
            // Renvoie un message si une exception a été lancée
            Session::put('fail', 'Ajout échoué. Veuillez saisir correctement les informations. ');
            return redirect()->back();
        }
    }

}
