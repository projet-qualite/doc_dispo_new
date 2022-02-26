<?php

namespace App\Http\Controllers;

use App\Models\Proche;
use Illuminate\Http\Request;
use Validator;
use Session;

use DB;

class ProcheController extends Controller
{
    // Vue pour l'ajour d'un proche
    public function ajouterProcheView()
    {
        if(Session::has('user'))
        {
            $proches = Proche::where('id_patient', Session::get('user')->id)->paginate(10);

            $definedOwner = false;

            foreach ($proches as $proche)
            {
                if($proche->owner == 1)
                {
                    $definedOwner = true;
                }
            }

            return view('back.pages.proche')
                ->with("action", "Ajouter")
                ->with("definedOwner", $definedOwner)
                ->with('proches', $proches);
        }
        abort(404);
    }


    // Ajout d'un proche
    public function ajouter(Request $request)
    {
        try{
            if(Session::has('user'))
            {
                $validator = Validator::make($request->all(),
                    [
                        'nom' => 'required',
                        'prenom' => 'required',
                        'sexe' => 'required',
                        'date_naissance' => 'required',
                        'owner' => 'required',
                        'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
                    ]
                );

                if($validator->fails())
                {
                    return back()->withErrors($validator)->withInput();
                }
                $proche = new Proche();
                $proche->nom = $request->nom;
                $proche->prenom = $request->prenom;
                $proche->date_naissance = $request->date_naissance;
                $proche->telephone = $request->telephone;
                $proche->sexe = $request->sexe;
                $proche->ville = $request->ville;
                $proche->commune = $request->commune;
                $proche->id_patient = Session::get('user')->id;

                if($request->owner != 1 && $request->owner != 0)
                {
                    $proche->owner = 0;
                }
                else if($request->owner == 1){

                    $proches = Proche::where('owner', 1)->get();
                    if(is_null($proches))
                    {
                        $proche->owner = 1;
                    }
                    else{
                        $proche->owner = 0;
                    }
                }
                else{
                    $proche->owner = 0;
                }


                $proche->save();

                Session::put('success', 'Votre proche a été ajouté avec succès');
                return redirect()->back();
            }
            else{
                abort(404);
            }
       }
        catch(\ Exception $e)
        {
            Session::put('fail', 'Une erreur s\'est produite. Veuillez vérifier vos informations.');
            return redirect()->back();
        }
    }

    // Suppression d'un proche
    public function supprimer($id)
    {

        try{

            if(Session::has('user'))
            {
                $patient = Proche::find($id);
                $patient->delete();
                Session::put('success_delete', 'Proche supprimée avec succès');
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


    //Vue pour la Modification d'un proche
    public function modifierView($slug)
    {
        if(Session::has('user'))
        {
            $proche = Proche::where('slug', $slug)->get()->first();
            $proches = Proche::where('id_patient', Session::get('user')->id)->paginate(10);

            if(is_null($proche))
            {
                abort(404);
            }
            else{
                return view('back.pages.proche')
                ->with("proches", $proches)
                ->with("action", "Modifier")
                ->with("proche", $proche);
            }

        }
        abort(404);
    }


    //Modification d'un proche
    public function modifier(Request $request, $id)
    {

        try{
            if(Session::has('user'))
            {
                $validator = Validator::make($request->all(),
                    [
                        'nom' => 'required',
                        'prenom' => 'required',
                        'sexe' => 'required',
                        'date_naissance' => 'required',
                        'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
                    ]
                );

                if($validator->fails())
                {
                    return back()->withErrors($validator)->withInput();
                }
                $proche = Proche::where('slug', $id)->first();
                if($proche->id_patient != Session::get('user')->id)
                {
                    abort(404);
                }
                $proche->nom = $request->nom;
                $proche->prenom = $request->prenom;
                $proche->date_naissance = $request->date_naissance;
                $proche->telephone = $request->telephone;
                $proche->sexe = $request->sexe;
                $proche->ville = $request->ville;
                $proche->commune = $request->commune;
                $proche->id_patient = Session::get('user')->id;


                if(isset($request->owner))
                {
                    $proche->owner = $request->owner;
                }


                $proche->update();

                Session::put('success', 'Proche modifiée avec succès');

                return redirect("/proche");
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
