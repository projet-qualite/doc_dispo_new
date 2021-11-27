<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motif;
use Session;
use Validator;

class MotifController extends Controller
{
    //

    public function view()
    {
        if(Session::has('admin'))
        {
            return view('back.pages.motif')
            ->with("action", "Ajouter")
            ->with("motifs", Motif::get());
        }
        abort(404);
    }

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


                $motif = new Motif();
                $motif->libelle = $request->libelle;

                $motif->save();


                Session::put('success', 'Informations enregistrées avec succès');

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

    public function supprimer(Request $request, $id)
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
