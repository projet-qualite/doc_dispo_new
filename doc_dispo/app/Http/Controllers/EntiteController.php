<?php

namespace App\Http\Controllers;

use App\Models\Entite;
use Illuminate\Http\Request;

use Session;
use Validator;

class EntiteController extends Controller
{
    //

    //public static function ajouter()

    public function ajouter(Request $request, $id)
    {
        try{
        if(Session::has('admin'))
        {

            $entite = Entite::create($request->all());

            /*$entite->titre = $request->titre;
            $entite->texte = $request->texte;
            $entite->lien = $request->lien;
            if(is_null($entite->lien))
            {
                $entite->lien = '';
            }
            $entite->id_partie = $id;
            $entite->save();*/


            Session::put('success', 'Ajout avec succès');

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


    public function modifier(Request $request, $id_partie, $id)
    {
        try{
            if(Session::has('admin'))
            {

                $entite = Entite::find($id);

                $entite->update($request->all());



                Session::put('success', 'Entité modifiée avec succès');

                return redirect()->back();
            }
            abort(404);

        }
        catch(\ Exception $e)
        {
            Session::put('fail', 'Une erreur s\'est produite.');
            return redirect()->back();
        }

    }


    public function supprimer($id)
    {
        if(Session::has('admin'))
        {
            $entite = Entite::find($id);
            if(is_null($entite))
            {
                abort(404);
            }

            try{
                $entite->delete();
                Session::put('success', 'Entité supprimée avec succès');
                return redirect()->back();
            }
            catch(\ Exception $e)
            {
                Session::put('fail', 'Une erreur s\'est produite.');
                return redirect()->back();
            }


        }
        abort(404);
    }

    public function imgModifier(Request $request, $id)
    {

        try{
            if(Session::has('admin'))
            {

                if($request->type == "logo")
                {
                    $entite = Entite::find(45);
                }
                else{
                    $entite = Entite::find(46);
                }

                $image = $request->file('img');
                $extention = $image->getClientOriginalName();
                $filename = pathinfo($extention, PATHINFO_FILENAME);
                $ext = $image->getClientOriginalExtension();
                $filesaver = 'img'.time().'.'.$ext;
                $path = $image->move('front/img/',$filesaver);

                $entite->img = $filesaver;
                $entite->update();



                Session::put('success', 'Entité modifiée avec succès');

                return redirect()->back();
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
