<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hopital;
use App\Models\Assurance;
use App\Models\Specialite;
use App\Models\Medecin;
use App\Models\Creneau;

use Session;
use Validator;
use DB;

class HopitalController extends Controller
{
    //

    // Connexion d'un hôpital
    public static function connexion(Request $request)
    {
        try{
            $hopital = Hopital::where('email', $request->email)->where('mdp',sha1($request->mot_de_passe))->first();

            if(is_null($hopital))
            {
                Session::put('fail', 'Email ou mot de passe incorrect.');
                return redirect()->back();
            }
            else{
                Session::put('hopital', $hopital);
                return redirect('/');
            }
        }
        catch(\ Exception $e)
        {
            Session::put('fail', 'Connexion échouée. Veuillez saisir correctement les informations. ');
            return redirect()->back();
        }
        
    }


    // Inscription d'un hôpital
    public static function inscription(Request $request)
    {
    
        try{
            $hopital = new Hopital();
            $hopital->email = $request->email;
            $hopital->telephone = $request->telephone;
            $hopital->mdp = sha1($request->mot_de_passe);

            $already_exist = Hopital::where('email', $request->email)->first();

            if(is_null($already_exist))
            {
                $hopital->save();
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


    public static function dashboard()
    {
        $medecinsH = DB::table('hopital')
                        ->join('medecin', 'medecin.id_hopital', '=', 'hopital.id')
                        ->select('medecin.*')
                        ->where('medecin.id_hopital', Session::get('hopital')->id)
                        ->get();


            $rdvH = DB::table('rdv')
                    ->join('creneau', 'creneau.id', '=', 'rdv.id_creneau')
                    ->join('motif_consultation', 'motif_consultation.id', '=', 'creneau.id_motif_consult')
                    ->join('medecin', 'medecin.id', '=', 'motif_consultation.id_medecin')
                    ->select('rdv.*', 'medecin.*')
                    ->where('medecin.id_hopital', Session::get('hopital')->id)
                    ->get();
            return view('back.pages.dashboard')->with('medecinsH', count($medecinsH))->with('rdvH', count($rdvH));
    }


    public function ajouterAffiliationView()
    {
        if(Session::has('hopital'))
        {
            $assurances = DB::table('affilier')
                            ->join('assurance', 'assurance.id', '=', 'affilier.id_assurance')
                            ->select('assurance.*', 'affilier.id_hopital', 'affilier.id AS id_affilier')
                            ->where('affilier.id_hopital', Session::get('hopital')->id)
                            ->get();

            return view('back.pages.affiliation')
            ->with('assurances', Assurance::get())
            ->with('assurances_h', $assurances);
        }
        abort(404);
    }





    public function ajouterSpecialiteView()
    {

        if(Session::has('hopital'))
        {
            $specialitesHopital = DB::table('specialite_hopital')
                            ->join('specialite', 'specialite.id', '=', 'specialite_hopital.id_specialite')
                            ->select('specialite.*', 'specialite_hopital.id_hopital', 'specialite_hopital.id AS id_specialite_hopital')
                            ->where('specialite_hopital.id_hopital', Session::get('hopital')->id)
                            ->get();

            return view('back.pages.specialite-hopital')
            ->with('specialites', Specialite::get())
            ->with('specialites_h', $specialitesHopital);
        }
        abort(404);
        
    }



    // Parametre d'un hopital
    public function parametre(Request $request)
    {
        try{
            if(Session::has('hopital'))
            {
                $validator = Validator::make($request->all(),
                    [
                        'libelle' => 'required',
                        'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                    ]
                );
                

                if($validator->fails())
                {
                    return back()->withErrors($validator)->withInput();
                }
                $hopital = Hopital::find(Session::get('hopital')->id);
            
                $hopital->libelle = $request->libelle;
                $hopital->telephone = $request->telephone;

                $hopital->update();

                Session::put('hopital', $hopital);

                Session::put('success', 'Informations enregistrées avec succès');

                return redirect()->back();
            }


            return redirect('/');
        }
        catch(\ Exception $e)
        {
            Session::put('fail', 'Inscription échouée. Veuillez saisir correctement les informations. ');
            return redirect()->back();
        }
        
    }


    // Parametre d'un hopital
    public function changeMdp(Request $request)
    {
        try{
            if(Session::has('hopital'))
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

                if(sha1($request->ancien_mdp) != Session::get("hopital")->mdp)
                {
                    $validator->errors()->add("ancien_mdp", "Le mot de passe est incorrect");
                    return back()->withErrors($validator)->withInput();
                }
                else if($request->nouveau_mdp != $request->c_nouveau_mdp)
                {
                    $validator->errors()->add("c_nouveau_mdp", "Le mot de passe est différent");
                    return back()->withErrors($validator)->withInput();
                }
                $hopital = Hopital::find(Session::get('hopital')->id);
            
                $hopital->mdp = sha1($request->nouveau_mdp);
                $hopital->update();

                Session::put('hopital', $hopital);

                Session::put('success_', 'Mot de passe modifié avec succès');

                return redirect()->back();
            }


            abort(404);
        }
        catch(\ Exception $e)
        {
            Session::put('fail_', 'Modification échouée. Veuillez saisir correctement les informations. ');
            return redirect()->back();
        }
        
    }



    public function medecins()
    {
        
        if(Session::has('hopital'))
        {
            $medecins = Medecin::where('id_hopital', Session::get('hopital')->id)->get();

            return view('back.pages.medecins-hopital')->with('medecins', $medecins);
        }


        abort(404);
       
        
    }



    public function hopitaux()
    {
        if(Session::has('admin'))
        {
            $hopitaux = Hopital::get();

            return view('back.pages.hopitaux')->with('hopitaux', $hopitaux);
        }
        abort(404);
    }



    public function activer($slug)
    {
        if(Session::has('admin'))
        {
            $hopital = Hopital::where('slug', $slug)->first();


            if(is_null($hopital))
            {
                $hopital = Hopital::where('id', $slug)->first();

                if(is_null($hopital))
                {
                    abort(404);
                }
                else{
                    $hopital->etat_compte = 1;
                    $hopital->update();
                    
                    return redirect()->back();
                }

            }
            else{
                $hopital->etat_compte = 1;
                $hopital->update();
                return redirect()->back();
            }
        }
        abort(404);
    }


    public function desactiver($slug)
    {
        if(Session::has('admin'))
        {
            $hopital = Hopital::where('slug', $slug)->first();

            if(is_null($hopital))
            {
                $hopital = Hopital::where('id', $slug)->first();

                if(is_null($hopital))
                {
                    abort(404);
                }
                else{
                    $hopital->etat_compte = 0;
                    $hopital->update();
                    return redirect()->back();
                }
            }
            else{
                $hopital->etat_compte = 0;
                $hopital->update();
                return redirect()->back();
            }
        }
        abort(404);
    }

    public function detailHopital($slug)
    {
        if(Session::has('admin'))
        {
            $hopital = Hopital::where('slug', $slug)->first();

            if(is_null($hopital))
            {
                $hopital = Hopital::where('id', $slug)->first();

                if(is_null($hopital))
                {
                    abort(404);
                }
                else{
                    $specialitesHopital = DB::table('specialite_hopital')
                                        ->join('specialite', 'specialite.id', '=', 'specialite_hopital.id_specialite')
                                        ->select('specialite.*', 'specialite_hopital.id_hopital')
                                        ->where('specialite_hopital.id_hopital', $hopital->id)
                                        ->get();
                    return view('back.pages.detail-admin-hopital')
                            ->with('hopital', $hopital)
                            ->with('specialites', $specialitesHopital);
                }
                
            }
            else{
                $specialitesHopital = DB::table('specialite_hopital')
                                        ->join('specialite', 'specialite.id', '=', 'specialite_hopital.id_specialite')
                                        ->select('specialite.*', 'specialite_hopital.id_hopital')
                                        ->where('specialite_hopital.id_hopital', $hopital->id)
                                        ->get();
                return view('back.pages.detail-admin-hopital')
                                        ->with('hopital', $hopital)
                                        ->with('specialites', $specialitesHopital);
            }
        }
        abort(404);
    }



    public function hopitauxAssurances($slug)
    {
        $assurance = Assurance::where('slug', $slug)->get()->first();
        $hopitaux = DB::table('hopital')
                    ->join('affilier', 'hopital.id', '=', 'affilier.id_hopital')
                    ->select('hopital.*', 'affilier.id_assurance')
                    ->where('affilier.id_assurance', $assurance->id)
                    ->get();
        

        //$medecins = Medecin::where('etat_compte', 1)->get();

        $allHopitaux = Hopital::get();
        $allSpecialites = Specialite::get();


        $medecins = [];

        foreach($hopitaux as $hopital)
        {
            $medecins [] = DB::table('medecin')
                        ->join('specialite', 'specialite.id', '=', 'medecin.id_specialite')
                        ->select('medecin.*', 'specialite.libelle')
                        ->where('medecin.id_hopital', $hopital->id)
                        ->where('etat_compte', 1)
                        ->first();
        }
            
            
            

        return view('front.pages.hopitaux-assurances')
                    ->with('hopitaux', $hopitaux)
                    ->with('medecins', $medecins)
                    ->with('allSpecialites', $allSpecialites)
                    ->with('allHopitaux', $allHopitaux);
    }




    public static function getHopital($slug)
    {
        $hopital = Hopital::where('slug', $slug)->get()->first();
        $id = $hopital->id;
        $assurances = DB::table('affilier')
                    ->join('hopital', 'hopital.id', '=', 'affilier.id_hopital')
                    ->join('assurance', 'assurance.id', '=', 'affilier.id_assurance')
                    ->select('assurance.*', 'hopital.id')
                    ->where('hopital.id', $id)
                    ->get();


        $all_medecins = DB::table('medecin')
                            ->join('specialite', 'specialite.id', '=', 'medecin.id_specialite')
                            ->select('medecin.*', 'specialite.libelle')
                            ->where('id_hopital', $id)
                            ->get();
        
        
        $creneaux = [];

        foreach($all_medecins as $medecin)
        {
            $creneaux [] = Creneau::where('id_medecin', $medecin->id)
                                    ->where('etat', 0)
                                    ->whereDate('jour', '>=', date('Y-m-d'))
                                    ->orderBy('jour', 'DESC')
                                    ->get();
        }


        


        $specialites = DB::table('specialite_hopital')
                        ->join('hopital', 'hopital.id', '=', 'specialite_hopital.id_hopital')
                        ->join('specialite', 'specialite.id', '=', 'specialite_hopital.id_specialite')
                        ->select('specialite.*','hopital.id as id_hopital')
                        ->where('id_hopital', $id)
                        ->get();

        return view('front.pages.hopital')
                    ->with('hopital', $hopital)
                    ->with('medecins', $all_medecins)
                    ->with('specialites', $specialites)
                    ->with('creneaux', $creneaux)
                    ->with('assurances', $assurances);
    }

    public static function rdvProchains()
    {
        $rdvs = DB::table('rdv')
                ->join('creneau', 'creneau.id', '=', 'rdv.id_creneau')
                ->join('medecin', 'medecin.id', '=', 'creneau.id_medecin')
                ->join('specialite', 'specialite.id', '=', 'medecin.id_specialite')
                ->join('proche', 'proche.id', '=', 'rdv.id_proche')
                ->select(
                    'creneau.jour',
                    'creneau.heure',
                    'rdv.slug as slug_rdv',
                    'rdv.etat',
                    'rdv.id_proche',
                    'specialite.libelle as libelle_specialite',
                    'medecin.*',
                    'proche.nom as nom_proche',
                    'proche.prenom as prenom_proche'
                )
                ->where('medecin.id_hopital', Session::get('hopital')->id)
                ->whereDate('creneau.jour', '>=', date('Y-m-d'))
                ->whereDate('creneau.heure', '>=', date('H:i'))
                ->orderBy('jour', 'ASC')
                ->get();

                                   
        
        return view('back.pages.rdv')->with('rdvs', $rdvs);

    }


    public static function rdvPasses()
    {
        $rdvs = DB::table('rdv')
                ->join('creneau', 'creneau.id', '=', 'rdv.id_creneau')
                ->join('medecin', 'medecin.id', '=', 'creneau.id_medecin')
                ->join('specialite', 'specialite.id', '=', 'medecin.id_specialite')
                ->join('proche', 'proche.id', '=', 'rdv.id_proche')
                ->select(
                    'creneau.jour',
                    'creneau.heure',
                    'rdv.slug as slug_rdv',
                    'rdv.etat',
                    'rdv.id_proche',
                    'specialite.libelle as libelle_specialite',
                    'medecin.*',
                    'proche.nom as nom_proche',
                    'proche.prenom as prenom_proche'
                )
                ->where('medecin.id_hopital', Session::get('hopital')->id)
                ->whereDate('creneau.jour', '<', date('Y-m-d'))
                ->whereDate('creneau.heure', '<', date('H:i'))
                ->orderBy('jour', 'DESC')
                ->get();

                                   
        
        return view('back.pages.rdv')->with('rdvs', $rdvs);

    }



}
