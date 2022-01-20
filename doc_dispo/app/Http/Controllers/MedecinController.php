<?php

namespace App\Http\Controllers;


use App\Models\Medecin;
use App\Models\Hopital;
use App\Models\Specialite;
use App\Models\Creneau;
use App\Models\Proche;
use Illuminate\Http\Request;
use App\Mail\MailAccount;
use Illuminate\Support\Facades\Mail;
use Validator;
use Session;
use DB;

class MedecinController extends Controller
{
    //
     // Pour connecter le medecin
     public static function connexion(Request $request)
     {
        try{
             $medecin = Medecin::where('email', $request->email)->where('mdp',sha1($request->mot_de_passe))->first();
             if(is_null($medecin))
             {
                 Session::put('fail', 'Email ou mot de passe incorrect.');
                 return redirect()->back();
             }
             else{
                 Session::put('medecin', $medecin);
                 return redirect('/');
             }
        }

        catch(\ Exception $e)
         {
             // Renvoie un message si une exception a été lancée
             Session::put('fail', 'Connexion échouée. Veuillez saisir correctement les informations. ');
             return redirect()->back();
         }
     }


     // Pour inscrire le medecin via le formulaire
     public static function inscription(Request $request)
     {
         try{
             $medecin = new Medecin();
             $medecin->email = $request->email;
             $medecin->telephone = $request->telephone;
             $medecin->mdp = sha1($request->mot_de_passe);

             $already_exist = Medecin::where('email', $request->email)->first();


             if(is_null($already_exist))
             {
                 $medecin->save();
                 Session::put('success', 'Inscription réussie. Vous pouvez désormais vous connecter.');
             }
             else{
                 Session::put('fail', 'Cette adresse mail existe déjà');
             }


             return redirect()->back();
         }
         catch(\ Exception $e)
         {
             Session::put('fail', 'Inscription échouée. Veuillez saisir correctement les informations. ');
             return redirect()->back();
         }
     }


    /*
     * Tableau de bord du medecins
     */
     public static function dashboard()
    {
            $rdvM = DB::table('rdv')
                    ->join('creneau', 'creneau.id', '=', 'rdv.id_creneau')
                    ->select('rdv.*', 'creneau.*')
                    ->where('creneau.id_medecin', Session::get('medecin')->id)
                    ->get();
            return view('back.pages.dashboard')->with('rdvM',count($rdvM));
    }


    // Vue pour les paramètres
    public static function parametreView()
    {
        if(Session::has('medecin'))
        {
            $hopitaux = Hopital::where('etat_compte', 1)->get();
            $specialitesHopital = DB::table('specialite_hopital')
                    ->join('specialite', 'specialite.id', '=', 'specialite_hopital.id_specialite')
                    ->select('specialite.*', 'specialite_hopital.id_hopital')
                    ->where('specialite_hopital.id_hopital', Session::get('medecin')->id_hopital)
                    ->get();

            $specialiteMedecin = DB::table('medecin')
                    ->join('specialite', 'specialite.id', '=', 'medecin.id_specialite')
                    ->select('specialite.*', 'medecin.id')
                    ->where('medecin.id', Session::get('medecin')->id)
                    ->first();


            $hopitalMedecin = DB::table('medecin')
                    ->join('hopital', 'hopital.id', '=', 'medecin.id_hopital')
                    ->select('hopital.*', 'medecin.id')
                    ->where('medecin.id', Session::get('medecin')->id)
                    ->first();


            return view('back.pages.parametre')
                ->with('hopitaux', $hopitaux)
                ->with('specialites', $specialitesHopital)
                ->with('specialite', $specialiteMedecin)
                ->with('hopital', $hopitalMedecin);
        }
        abort(404);
    }




    // Parametre d'un medecin
    public function parametre(Request $request)
    {


        try{
            if(Session::has('medecin'))
            {
                $validator = Validator::make($request->all(),
                    [
                        'telephone' => 'required',
                    ]
                );


                if($validator->fails())
                {
                    return back()->withErrors($validator)->withInput();
                }
                $medecin = Medecin::find(Session::get('medecin')->id);


                // Pour l'ajout de la photo de profil du medecin
                if(!is_null($request->file('photo')))
                {
                    $image = $request->file('photo');
                    $extention = $image->getClientOriginalName();
                    $filename = pathinfo($extention, PATHINFO_FILENAME);
                    $ext = $image->getClientOriginalExtension();
                    $filesaver = 'img_h_'.time().'.'.$ext;
                    $path = $image->move('front/img/medecins/',$filesaver);


                    $medecin->img_1 = $filesaver;
                }



                $medecin->nom = $request->nom;
                $medecin->prenom = $request->prenom;
                $medecin->date_naissance = $request->date_naissance;
                $medecin->sexe = $request->sexe;
                $medecin->telephone = $request->telephone;

                $medecin->type = $request->type_medecin;

                $medecin->biographie = $request->biographie;

                if(Session::get('medecin')->etat_compte == 0)
                {
                    $medecin->id_hopital = $request->hopital;
                    if(Session::get('medecin')->id_hopital != $medecin->id_hopital)
                    {
                        $medecin->id_specialite = null;
                    }

                }


                $medecin->update();




                Session::put('medecin', $medecin);

                Session::put('success', 'Informations enregistrées avec succès');

                return redirect()->back();
            }


            return redirect('/');
        }
        catch(\ Exception $e)
        {
            Session::put('fail', 'Modification échouée. Veuillez saisir correctement les informations. ');
            return redirect()->back();
        }

    }

    // Pour l'ajout de la spécialité du medecin
    public function parametreSpecialite(Request $request)
    {


        try{
            if(Session::has('medecin'))
            {
                $validator = Validator::make($request->all(),
                    [
                        'hopital_specialite' => 'required',
                    ]
                );


                if($validator->fails())
                {
                    return back()->withErrors($validator)->withInput();
                }
                $medecin = Medecin::find(Session::get('medecin')->id);

                $medecin->id_specialite = $request->hopital_specialite;
                $medecin->update();

                Session::put('medecin', $medecin);

                Session::put('success_', 'Informations enregistrées avec succès');

                return redirect()->back();
            }


            return redirect('/');
        }
        catch(\ Exception $e)
        {
            Session::put('fail_', 'Modification échouée. Veuillez saisir correctement les informations. ');
            return redirect()->back();
        }

    }


    // Pour changer le mot de passe d'un medecin
    public function changeMdp(Request $request)
    {
        try{
            if(Session::has('medecin'))
            {
                $validator = Validator::make($request->all(),
                    [
                        'ancien_mdp' => 'required|min:8',
                        'nouveau_mdp' => 'required|min:8',
                        'c_nouveau_mdp' => 'required|min:8',
                    ]
                );


                if($validator->fails())
                {
                    return back()->withErrors($validator)->withInput();
                }

                if(sha1($request->ancien_mdp) != Session::get("medecin")->mdp)
                {
                    $validator->errors()->add("ancien_mdp", "Le mot de passe est incorrect");
                    return back()->withErrors($validator)->withInput();
                }
                else if($request->nouveau_mdp != $request->c_nouveau_mdp)
                {
                    $validator->errors()->add("c_nouveau_mdp", "Le mot de passe est différent");
                    return back()->withErrors($validator)->withInput();
                }
                $medecin = Medecin::find(Session::get('medecin')->id);

                $medecin->mdp = sha1($request->nouveau_mdp);
                $medecin->update();

                Session::put('medecin', $medecin);

                Session::put('success__', 'Mot de passe modifié avec succès');

                return redirect()->back();
            }


            abort(404);
        }
        catch(\ Exception $e)
        {
            Session::put('fail__', 'Modification échouée. Veuillez saisir correctement les informations. ');
            return redirect()->back();
        }

    }

    // Pour activer le compte d'un medecin
    public function activer($slug)
    {
        if(Session::has('hopital'))
        {
            $medecin = Medecin::where('slug', $slug)->first();

            if($medecin->id_hopital != Session::get('hopital')->id)
            {
                abort(404);
            }


            if(is_null($medecin))
            {
                abort(404);
            }
            else{
                if(is_null($medecin->nom) || is_null($medecin->prenom)
                    || is_null($medecin->biographie) || is_null($medecin->type )|| is_null($medecin->id_specialite))
                {
                    Session::put('fail', 'Vous ne pouvez pas activer ce compte. Des informations sont manquantes.');
                    return redirect()->back();
                }
                $medecin->etat_compte = 1;
                $medecin->update();
                return redirect()->back();
            }
        }
        abort(404);
    }

    // Pour désactiver le compte d'un medecin
    public function desactiver($slug)
    {
        if(Session::has('hopital'))
        {
            $medecin = Medecin::where('slug', $slug)->first();

            if(is_null($medecin))
            {
                abort(404);
            }
            else{
                $medecin->etat_compte = 0;
                $medecin->update();
                return redirect()->back();
            }
        }
        abort(404);
    }

    // Détail d'un medecin sur la page de d'un hopital
    public function detailMedecin($slug)
    {
        if(Session::has('hopital'))
        {
            $medecin = DB::table('medecin')
                        ->join('specialite', 'specialite.id', '=', 'medecin.id_specialite')
                        ->select('medecin.*', 'specialite.libelle AS specialite')
                        ->where('medecin.slug', $slug)
                        ->first();

            if(is_null($medecin))
            {
                abort(404);
            }
            else{
                return view('back.pages.detail-medecin-hopital')->with('medecin', $medecin);
            }
        }
        abort(404);
    }



    // Liste des médecins pratiquant la spécialité
    public function medecinsSpecialite($specialite)
    {
        $allHopitaux = Hopital::get();
        $allSpecialites = Specialite::get();

        $medecins = DB::table('medecin')
                    ->join('specialite', 'specialite.id', '=', 'medecin.id_specialite')
                    ->join('hopital', 'hopital.id', '=', 'medecin.id_hopital')
                    ->select('medecin.*', 'specialite.slug AS s', 'specialite.libelle AS libelle_specialite', 'hopital.libelle AS libelle_hopital')
                    ->where('specialite.slug', $specialite)
                    ->where('medecin.etat_compte', 1)
                    ->get();

        $creneaux = [];

        foreach($medecins as $medecin)
        {
            $creneaux [] = Creneau::where('id_medecin', $medecin->id)
                                    ->where('etat', 0)
                                    ->whereDate('jour', '>=', date('Y-m-d'))
                                    ->orderBy('jour', 'DESC')
                                    ->get();
        }



        return view('front.pages.medecins')
                ->with('medecins', $medecins)
                ->with('creneaux', $creneaux)
                ->with('specialites', $allSpecialites)
                ->with('hopitaux', $allHopitaux);
    }


    // Page de détail d'un medecin
    public static function medecin($slug)
    {
        $medecin = Medecin::where('slug', $slug)->get()->first();
        $id = $medecin->id;
        $creneaux = Creneau::where('id_medecin', $medecin->id)
                            ->where('etat', 0)
                            ->whereDate('jour', '>=', date('Y-m-d'))
                            ->whereTime('heure', '>=', date('H.i'))
                            ->orderBy('jour', 'ASC')
                            ->orderBy('heure', 'ASC')
                            ->get();

        $motifs = DB::table('motif')
                            ->join('motif_consultation', 'motif_consultation.id_motif', '=', 'motif.id')
                            ->select('motif.*', 'motif_consultation.id_medecin', 'motif_consultation.id AS id_motif_consult')
                            ->where('motif_consultation.id_medecin', $id)
                            ->get();

        if(Session::has('user'))
        {
            $proches = Proche::where('id_patient', Session::get('user')->id)->get();
            return view('front.pages.medecin')->with('medecin', $medecin)
                                                ->with('creneaux', $creneaux)
                                                ->with('motifs', $motifs)
                                                ->with('proches', $proches);
        }



        return view('front.pages.medecin')->with('medecin', $medecin)
                                        ->with('creneaux', $creneaux)
                                        ->with('motifs', $motifs);


    }


    // Renvoie tous les medecins
    public static function getMedecins()
    {
        $allHopitaux = Hopital::where('etat_compte', 1)->orderBy('libelle', 'asc')->get();
        $allSpecialites = Specialite::orderBy('libelle', 'asc')->get();

        $medecins = DB::table('medecin')
                    ->join('specialite', 'specialite.id', '=', 'medecin.id_specialite')
                    ->join('hopital', 'hopital.id', '=', 'medecin.id_hopital')
                    ->select('medecin.*', 'specialite.slug AS s', 'specialite.libelle AS libelle_specialite', 'hopital.libelle AS libelle_hopital')
                    ->where('medecin.etat_compte', 1)
                    ->orderBy('nom', 'asc')
                    ->get();

        $creneaux = [];


        foreach($medecins as $medecin)
        {
            $creneaux [] = Creneau::where('id_medecin', $medecin->id)
                                    ->where('etat', 0)
                                    ->whereDate('jour', '>=', date('Y-m-d'))
                                    ->whereTime('heure', '>=', date('H.i'))
                                    ->orderBy('jour', 'ASC')
                                    ->orderBy('heure', 'ASC')
                                    ->get();
        }


        return view('front.pages.medecins')
                ->with('medecins', $medecins)
                ->with('creneaux', $creneaux)
                ->with('specialites', $allSpecialites)
                ->with('hopitaux', $allHopitaux);

    }


    // Prochains rdv d'un medecin
    public static function rdvProchains()
    {
        $rdvs = DB::table('rdv')
                ->join('creneau', 'creneau.id', '=', 'rdv.id_creneau')
                ->join('proche', 'proche.id', '=', 'rdv.id_proche')
                ->select(
                    'creneau.*',
                    'rdv.slug as slug_rdv',
                    'rdv.etat',
                    'rdv.id_proche',
                    'proche.*',
                )
                ->where('creneau.id_medecin', Session::get('medecin')->id)
                ->whereDate(DB::raw("CONVERT(CONCAT(creneau.jour, ' ', creneau.heure), DATETIME)"), '>=', time())
                ->orderBy('creneau.jour', 'asc')
                ->orderBy(DB::raw("CONVERT(creneau.heure, DOUBLE)"), 'asc')
                ->get();


        return view('back.pages.rdv')->with('rdvs', $rdvs);

    }

    // Rdvs passés d'un medecin
    public static function rdvPasses()
    {
        $rdvs = DB::table('rdv')
                ->join('creneau', 'creneau.id', '=', 'rdv.id_creneau')
                ->join('proche', 'proche.id', '=', 'rdv.id_proche')
                ->select(
                    'creneau.*',
                    'rdv.slug as slug_rdv',
                    'rdv.etat',
                    'rdv.id_proche',
                    'proche.*',
                )
                ->where('creneau.id_medecin', Session::get('medecin')->id)
                ->whereDate(DB::raw("CONVERT(CONCAT(creneau.jour, ' ', creneau.heure), DATETIME)"), '<=', time())
                ->orderBy('creneau.jour', 'asc')
                ->orderBy(DB::raw("CONVERT(creneau.heure, DOUBLE)"), 'asc')
                ->get();



        return view('back.pages.rdv')->with('rdvs', $rdvs);

    }


    // Pour réinitialiser le mot de passe
    public static function forgot(Request $request, $token)
    {
        try{
            $medecin = Medecin::where('email', $request->email)->first();

            if(is_null($medecin))
            {
                Session::put('fail','Cette adresse mail n\'existe pas');
            }
            else{
                /*$medecin->mdp = sha1('1234567890');
                $medecin->update();*/
                $message = "Veuillez réinitialiser votre mot de passe à partir du lien suivant: ";
                $link = gethostname()."/forgot/".$token."/".$request->email;
                $informations = ["Mot de passe oublié", $message, $link];
                Mail::to($medecin->email)->send(new MailAccount($informations));
                Session::put('success','Vous avez reçu un email pour la réinitialisation du mot de passe');
            }

            return redirect()->back();
        }
        catch(\Exception $e)
       {
            Session::put('fail', 'Une erreur s\'est produite.');
            return redirect()->back();
       }
    }


    public static function resetUpdate(Request $request, $email)
    {
        try{
            $medecin = Medecin::where('email', $email)->first();

            if(is_null($medecin))
            {
                Session::put('fail','Cette adresse mail n\'existe pas');
            }
            else{
                $medecin->mdp = sha1($request->mot_de_passe);
                $medecin->update();
                Session::put('success','Mot de passe réinitialisé avec succès');
            }

            return redirect("/connexion");
        }
        catch(\Exception $e)
        {
            Session::put('fail', 'Une erreur s\'est produite.');
            return redirect()->back();
        }
    }

}
