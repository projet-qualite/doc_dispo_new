<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Proche;
use Session;
use Validator;
use App\Mail\MailAccount;
use Illuminate\Support\Facades\Mail;

use DB;
use DateTime;


class PatientController extends Controller
{
    // Inscription d'un patient
    public static function inscription(Request $request)
    {
        try{
            $patient = new Patient();
            $patient->email = $request->email;
            $patient->telephone = $request->telephone;
            $patient->mdp = sha1($request->mot_de_passe);

            $already_exist = Patient::where('email', $request->email)->first();


            if(is_null($already_exist))
            {
                $patient->save();
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


    // Connexion d'un patient
    public static function connexion(Request $request)
    {
        try{
            $user = Patient::where('email', $request->email)->where('mdp',sha1($request->mot_de_passe))->first();


            if(is_null($user))
            {
                Session::put('fail', 'Email ou mot de passe incorrect.');
                return redirect()->back();
            }
            else{
                Session::put('user', $user);
                return redirect('/');
            }
        }
        catch(\ Exception $e)
        {
            Session::put('fail', 'Connexion échouée. Veuillez saisir correctement les informations. ');
            return redirect()->back();
        }
    }


    // Dashboard d'un patient
    public static function dashboard()
    {
        $prochesU = Proche::where('id_patient', Session::get('user')->id)->get();
        $rdvU = DB::table('rdv')
                    ->join('proche', 'proche.id', '=', 'rdv.id_proche')
                    ->join('patient', 'patient.id', '=', 'proche.id_patient')
                    ->select('rdv.*', 'proche.*')
                    ->where('proche.id_patient', Session::get('user')->id)
                    ->get();

        return view('back.pages.dashboard')->with('prochesU', count($prochesU))->with('rdvU', count($rdvU));
    }


    // Modification du mot de passe d'un patient
    public function changeMdp(Request $request)
    {
        try{
            if(Session::has('user'))
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

                if(sha1($request->ancien_mdp) != Session::get("user")->mdp)
                {
                    $validator->errors()->add("ancien_mdp", "Le mot de passe est incorrect");
                    return back()->withErrors($validator)->withInput();
                }
                else if($request->nouveau_mdp != $request->c_nouveau_mdp)
                {
                    $validator->errors()->add("c_nouveau_mdp", "Le mot de passe est différent");
                    return back()->withErrors($validator)->withInput();
                }
                $patient = Patient::find(Session::get('user')->id);

                $patient->mdp = sha1($request->nouveau_mdp);
                $patient->update();

                Session::put('user', $patient);

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



    // Parametre d'un medecin
    public function parametre(Request $request)
    {


        try{
            if(Session::has('user'))
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
                $patient = Patient::find(Session::get('user')->id);

                $patient->telephone = $request->telephone;
                $patient->update();


                Session::put('user', $patient);

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


    // Prochains rdv d'un patient
    public static function rdvProchains()
    {

        $rdvs = DB::table('rdv')
                ->join('creneau', 'creneau.id', '=', 'rdv.id_creneau')
                ->join('medecin', 'medecin.id', '=', 'creneau.id_medecin')
                ->join('specialite', 'specialite.id', '=', 'medecin.id_specialite')
                ->join('hopital', 'hopital.id', '=', 'medecin.id_hopital')
                ->join('proche', 'proche.id', '=', 'rdv.id_proche')
                ->select(
                    'creneau.jour as jour',
                    'creneau.heure as heure',
                    'rdv.slug as slug_rdv',
                    'rdv.etat',
                    'rdv.id_proche',
                    'hopital.libelle as libelle_hopital',
                    'specialite.libelle as libelle_specialite',
                    'medecin.*',
                    'proche.nom as nom_proche',
                    'proche.prenom as prenom_proche',
                )
                ->where('proche.id_patient', Session::get('user')->id)
                ->orderBy(DB::raw("CONVERT(jour, DATETIME)"), 'asc')
                ->orderBy(DB::raw("CONVERT(heure, DOUBLE)"), 'asc')
                ->get();


        $rdvsProchains = [];

        foreach ($rdvs as $rdv)
        {
            $concat = $rdv->jour." ".$rdv->heure;
            $timestamp = strtotime($concat);
            if($timestamp >= time())
            {
                $rdvsProchains [] = $rdv;
            }

        }

        return view('back.pages.rdv')->with('rdvs', $rdvsProchains);

    }

    // Rdvs passés d'un patient
    public static function rdvPasses()
    {
        $rdvs = DB::table('rdv')
                ->join('creneau', 'creneau.id', '=', 'rdv.id_creneau')
                ->join('medecin', 'medecin.id', '=', 'creneau.id_medecin')
                ->join('specialite', 'specialite.id', '=', 'medecin.id_specialite')
                ->join('hopital', 'hopital.id', '=', 'medecin.id_hopital')
                ->join('proche', 'proche.id', '=', 'rdv.id_proche')
                ->select(
                    'creneau.jour as jour',
                    'creneau.heure as heure',
                    'rdv.slug as slug_rdv',
                    'rdv.etat',
                    'rdv.id_proche',
                    'hopital.libelle as libelle_hopital',
                    'specialite.libelle as libelle_specialite',
                    'medecin.*',
                    'proche.nom as nom_proche',
                    'proche.prenom as prenom_proche',
                )
                ->where('proche.id_patient', Session::get('user')->id)
                ->orderBy(DB::raw("CONVERT(jour, DATETIME)"), 'desc')
                ->orderBy(DB::raw("CONVERT(heure, DOUBLE)"), 'desc')
                ->get();

        $rdvsPasses = [];

        foreach ($rdvs as $rdv)
        {
            $concat = $rdv->jour." ".$rdv->heure;
            $timestamp = strtotime($concat);
            if($timestamp <= time())
            {
                $rdvsPasses [] = $rdv;
            }

        }

        return view('back.pages.rdv')->with('rdvs', $rdvsPasses);

    }


     // Pour réinitialiser le mot de passe
     public static function forgot(Request $request, $token)
     {
         try{
             $patient = Patient::where('email', $request->email)->first();

             if(is_null($patient))
             {
                 Session::put('fail','Cette adresse mail n\'existe pas');
             }
             else{

                 $message = "Veuillez réinitialiser votre mot de passe à partir du lien suivant:";
                 $link = $_SERVER['SERVER_NAME']."/forgot/".$token."/".$request->email;
                 $informations = ["Mot de passe oublié", $message, $link];
                 Mail::to($patient->email)->send(new MailAccount($informations));
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


    // Modification du mot de passe
    public static function resetUpdate(Request $request, $email)
    {
        try{
            $patient = Patient::where('email', $email)->first();

            if(is_null($patient))
            {
                Session::put('fail','Cette adresse mail n\'existe pas');
            }
            else{
                $patient->mdp = sha1($request->mot_de_passe);
                $patient->update();
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
