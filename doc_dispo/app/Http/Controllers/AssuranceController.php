<?php

namespace App\Http\Controllers;

use App\Models\Assurance;
use Illuminate\Http\Request;
use Validator;
use Session;

class AssuranceController extends Controller
{

    // Vue pour l'ajout d'une assurance
    public function view()
    {
        if(Session::has('admin'))
        {
            return view('back.pages.assurance')
            ->with("action", "Ajouter")
            ->with("assurances", Assurance::orderBy('libelle', 'asc')->get());
        }
        abort(404);
    }



    // Ajout d'une assurance
    public function ajouter(Request $request)
    {
        try{
            if(Session::has('admin'))
            {
                $validator = Validator::make($request->all(), [
                    'libelle' => 'required',
                    'logo' => 'required',
                ]);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }


                $assurance = new Assurance();

                $assurance->libelle = $request->libelle;
                $image = $request->file('logo');
                $extention = $image->getClientOriginalName();
                $filename = pathinfo($extention, PATHINFO_FILENAME);
                $ext = $image->getClientOriginalExtension();
                $filesaver = 'img_a_'.time().'.'.$ext;
                $path = $image->move('front/img/assurances/',$filesaver);


                $assurance->logo = $filesaver;


                $assurance->save();

                Session::put('success', 'Assurance enregistrée avec succès');

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

    // Suppression d'une assurance
    public function supprimer(Request $request, $id)
    {

        try{

            if(Session::has('admin'))
            {
                $assurance = Assurance::find($id);


                $assurance->delete();
                Session::put('success_delete', 'Assurance supprimée avec succès');
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


    //Vue pour la modification d'une assurance
    public function modifierView($slug)
    {
        if(Session::has('admin'))
        {
            $assurance = Assurance::where('slug', $slug)->get()->first();

            if(is_null($assurance))
            {
                abort(404);
            }
            else{
                return view('back.pages.assurance')
                ->with("assurances", Assurance::get())
                ->with("action", "Modifier")
                ->with("assurance", $assurance);
            }

        }
        abort(404);
    }


    //Modification d'une assurance
    public function modifier(Request $request, $id)
    {
        //dd("he");
        try{
            if(Session::has('admin'))
            {
                $validator = Validator::make($request->all(), [
                    'libelle' => 'required',
                ]);





                $assurance = Assurance::where('slug', $id)->get()->first();

                if(!(is_null($request->file('logo'))))
                {
                    $validator = Validator::make($request->all(), [
                        'libelle' => 'required',
                        'logo' => 'required',
                    ]);

                    if ($validator->fails()) {
                        return back()->withErrors($validator)->withInput();
                    }

                    $image = $request->file('logo');
                    $extention = $image->getClientOriginalName();
                    $filename = pathinfo($extention, PATHINFO_FILENAME);
                    $ext = $image->getClientOriginalExtension();
                    $filesaver = 'img_a_'.time().'.'.$ext;
                    $path = $image->move('front/img/assurances/',$filesaver);

                    $assurance->logo = $filesaver;
                }







                $assurance->libelle = $request->libelle;

                $assurance->update();

                Session::put('success', 'Assurance modifiée avec succès');

                return redirect("/assurance");
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
