<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Entite;
use App\Models\Partie;
use Illuminate\Http\Request;
use Validator;
use Session;
use function PHPUnit\Framework\isNull;

class AdminController extends Controller
{
    //
    // Connexion de l'administrateur
    public function connexion(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'email' => 'required',
                'mot_de_passe' => 'required',
            ]
        );

        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }


        try{
            $admin = Admin::where('email', $request->email)->where('mdp',sha1($request->mot_de_passe))->first();
            if(is_null($admin))
            {
                Session::put('fail', 'Email ou mot de passe incorrect.');
                return redirect()->back();
            }
            else{
                Session::put('admin', $admin);
                return redirect('/');

            }
        }
        catch(\ Exception $e)
        {
            Session::put('fail', 'Une erreur s\'est produite. Veuillez vérifier vos informations.');
            return redirect()->back();
        }
    }




    public function showView($id)
    {

        if(Session::has('admin'))
        {


            switch($id)
            {
                case 1:
                    return view('back.pages.admin.accueil')
                        ->with("action", "")
                        ->with("entites", Entite::where('id_partie', 1)->get()
                        );
                    break;

                case 3:
                    return view('back.pages.admin.comment_ca_marche')
                        ->with("action", "")
                        ->with("entites", Entite::where('id_partie', 3)->get()
                        );
                    break;

                case 8:
                    return view('back.pages.admin.footer')
                        ->with("action", "")
                        ->with("entites", Entite::where('id_partie', 8)->get()
                        );
                    break;

                case 9:
                    return view('back.pages.admin.navbar')
                        ->with("action", "")
                        ->with("entites", Entite::where('id_partie', 9)->get()
                        );
                    break;

                case 10:
                    return view('back.pages.admin.logo')
                        ->with("action", "")
                        ->with("entites", Entite::where('id_partie', 10)->get()
                        );
                    break;

                case 11:
                    return view('back.pages.admin.politique')
                        ->with("action", "")
                        ->with("entites", Entite::where('id_partie', 11)->get()
                        );
                    break;
            }

        }
        abort(404);
    }


    public function modifierEntiteView($id_partie, $id)
    {

        if(Session::has('admin'))
        {

            $entite = Entite::find($id);

            if(is_null($entite))
            {
                abort(404);
            }


            switch($id_partie)
            {
                case 1:
                    return view('back.pages.admin.accueil')
                        ->with("action", "Modifier")
                        ->with("entites", Entite::where('id_partie', 1)->get())
                        ->with("entite", $entite);
                    break;

                case 3:
                    return view('back.pages.admin.comment_ca_marche')
                        ->with("action", "Modifier")
                        ->with("entites", Entite::where('id_partie', 3)->get())
                        ->with("entite", $entite);
                    break;

                case 8:
                    return view('back.pages.admin.footer')
                        ->with("action", "Modifier")
                        ->with("entites", Entite::where('id_partie', 8)->get())
                        ->with("entite", $entite);
                    break;

                case 9:
                    return view('back.pages.admin.navbar')
                        ->with("action", "Modifier")
                        ->with("entites", Entite::where('id_partie', 9)->get())
                        ->with("entite", $entite);
                    break;

                case 11:
                    return view('back.pages.admin.politique')
                        ->with("action", "Modifier")
                        ->with("entites", Entite::where('id_partie', 11)->get())
                        ->with("entite", $entite);
                    break;
            }

        }
        abort(404);
    }

    public function navAjout(Request $request)
    {
        //try{
            if(Session::has('admin'))
            {
                $validator = Validator::make($request->all(), [
                    'texte' => 'required',
                ]);


                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                $entite = new Entite();
                $entite->texte = $request->texte;
                $entite->lien = $request->lien;
                if(is_null($entite->lien))
                {
                    $entite->lien = '';
                }
                $entite->id_partie = 9;
                $entite->save();


                Session::put('success', 'Ajout avec succès');

                return redirect()->back();
            }
            abort(404);
       /* }
        catch(\ Exception $e)
        {
            // Renvoie un message si une exception a été lancée
            Session::put('fail', 'Ajout échoué. Veuillez saisir correctement les informations. ');
            return redirect()->back();
        }*/
    }


    public function modifierNavBarView($texte)
    {
        if(Session::has('admin'))
        {
            $entite = Entite::where('texte', $texte)->get()->first();

            if(is_null($entite))
            {
                abort(404);
            }
            else{
                return redirect()->back();
            }

        }
        abort(404);
    }


    /*public function modifierNavBar(Request $request, $texte)
    {
        try{
            if(Session::has('admin'))
            {
                $validator = Validator::make($request->all(), [
                    'libelle' => 'required',
                ]);



                $entite = Entite::where('texte', $texte)->get()->first();


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



    }*/

}
