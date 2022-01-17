<?php

namespace App\Http\Controllers;

use App\Models\Specialite;
use Illuminate\Http\Request;
use Validator;
use Session;

class SpecialiteController extends Controller
{

    // Afficher la vue pour ajouter des spécialités
    public function view()
    {
        if(Session::has('admin'))
        {
            return view('back.pages.specialite')
            ->with("action", "Ajouter")
            ->with("specialites", Specialite::orderBy('libelle', 'asc')->get());
        }
        abort(404);
    }



    // Ajout d'une spécialite
    public function ajouter(Request $request)
    {
        try{
            if(Session::has('admin'))
            {
                $validator = Validator::make($request->all(), [
                    'libelle' => 'required',
                ]);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                $alreadyExist = Specialite::where('libelle', $request->libelle)->first();
                if(is_null($alreadyExist))
                {
                    $specialite = new Specialite();
                    $specialite->libelle = $request->libelle;
                    $specialite->save();
                    Session::put('success', 'Spécialité enregistrée avec succès');
                }
                else{
                    Session::put('fail', 'Spécialité déjà existante');
                }


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

    // Suppression d'une spécialité
    public function supprimer(Request $request, $id)
    {

        try{

            if(Session::has('admin'))
            {
                $specialite = Specialite::find($id);


                $specialite->delete();
                Session::put('success_delete', 'Spécialité supprimée avec succès');
                return redirect()->back();
            }
            abort(404);

        }
        catch(\ Exception $e)
        {
            Session::put('fail_delete', 'Vous ne pouvez pas éffectuer cette opération');
            return redirect()->back();
        }


    }


    //Modification d'une spécialité
    public function modifierView($slug)
    {
        if(Session::has('admin'))
        {
            $specialite = Specialite::where('slug', $slug)->get()->first();

            if(is_null($specialite))
            {
                abort(404);
            }
            else{
                return view('back.pages.specialite')
                ->with("specialites", Specialite::get())
                ->with("action", "Modifier")
                ->with("specialite", $specialite);
            }

        }
        abort(404);
    }


    //Modification d'une spécialité
    public function modifier(Request $request, $id)
    {

        try{
            if(Session::has('admin'))
            {
                $validator = Validator::make($request->all(), [
                    'libelle' => 'required',
                ]);


                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }


                $specialite = Specialite::where('slug', $id)->get()->first();

                $specialite->libelle = $request->libelle;

                $specialite->update();

                Session::put('success', 'Spécialité modifiée avec succès');

                return redirect("/specialite");
            }
            abort(404);

        }
        catch(\ Exception $e)
        {
            Session::put('fail', 'Une erreur s\'est produite.');
            return redirect()->back();
        }


    }

}
