<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motif;
use Session;
use Validator;

class MotifController extends Controller
{
    //
    // Vue de la page pour ajouter les motifs
    public function view()
    {
        if(Session::has('admin'))
        {
            return view('back.pages.motif')
            ->with("action", "Ajouter")
            ->with("motifs", Motif::orderBy('libelle', 'asc')->get());
        }
        abort(404);
    }


    // Ajout d'un motif
    public function ajouter(Request $request)
    {
        try{
            if(Session::get('admin'))
            {
                $validator = Validator::make($request->all(),
                    [
                        'libelle' => 'required',
                    ]
                );


                if($validator->fails())
                {
                    return back()->withErrors($validator)->withInput();
                }


                $alreadyExist = Motif::where('libelle', $request->libelle)->first();
                if(is_null($alreadyExist))
                {
                    $motif = new Motif();
                    $motif->libelle = $request->libelle;
                    $motif->save();
                    Session::put('success', 'Informations enregistrées avec succès');
                }
                else{
                    Session::put('fail', 'Motif déjà existant');
                }




                return redirect()->back();



            }
            abort(404);
        }
        catch(\ Exception $e)
        {
            Session::put('fail', 'Ajout échoué. Veuillez saisir correctement les informations. ');
            return redirect()->back();
        }
    }


    // Vue pour la modification d'un motif
    public function modifierView($slug)
    {
        if(Session::has('admin'))
        {
            $motif = Motif::where('slug', $slug)->get()->first();

            if(is_null($motif))
            {
                abort(404);
            }
            else{
                return view('back.pages.motif')
                ->with("motifs", Motif::get())
                ->with("action", "Modifier")
                ->with("motif", $motif);
            }

        }
        abort(404);
    }


    // Modifier un motif
    public function modifier(Request $request, $id)
    {
        try{
            if(Session::get('admin'))
            {
                $validator = Validator::make($request->all(),
                [
                    'libelle' => 'required',
                ]
                );


                if($validator->fails())
                {
                    return back()->withErrors($validator)->withInput();
                }

                $motif = Motif::where('slug', $id)->get()->first();
                $motif->libelle = $request->libelle;

                $motif->update();


                Session::put('success', 'Informations modifiées avec succès');

                return redirect()->back();
            }
            abort(404);
        }
        catch(\ Exception $e)
        {
            Session::put('fail', 'Modification échouée. Veuillez saisir correctement les informations. ');
            return redirect()->back();
        }
    }

    // Supression d'un motif
    public function supprimer($id)
    {
        try{
            if(Session::get('admin'))
            {
                $motif = Motif::find($id);

                $motif->delete();
                Session::put('success_delete', 'Motif supprimé avec succès');
                return redirect()->back();
            }
            abort(404);
        }
        catch(\ Exception $e)
        {
            Session::put('fail_delete', 'Suppression échouée.');
            return redirect()->back();
        }
    }
}
