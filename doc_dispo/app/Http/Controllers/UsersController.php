<?php

namespace App\Http\Controllers;

use App\Models\Assurance;
use App\Models\Entite;
use App\Models\Medecin;
use App\Models\Hopital;
use App\Models\PasswordResets;
use App\Models\Specialite;
use App\Models\Rdv;
use Illuminate\Http\Request;
use Session;
use Validator;

use DB;

class UsersController extends Controller
{
    //

    // Pae d'accueil
    public function homepage()
    {
        /*
         * On récupère tous les medecins (qui ont un compte actif), les spécialités , les hôpitaux et les assurances pour
         * la recherche dans la searchbar
         */
        $medecins = Medecin::where('etat_compte', 1)->get();
        $specialites = Specialite::orderBy('libelle', 'asc')->get();
        $hopitaux = Hopital::where('etat_compte', 1)->get();
        $assurances = Assurance::orderBy('libelle', 'asc')->get();



        return view('front.pages.home')->with('medecins', $medecins)
            ->with('hopitaux', $hopitaux)
            ->with('specialites', $specialites)
            ->with('assurances', $assurances);
    }

    // la page des partenaires ( pas encore disponible )
    public function partenaires()
    {
        return view('front.pages.partenaires');
    }

    // Page comment ça marche
    public function commentCaMarche()
    {
        return view('front.pages.how_it_works');
    }

    // la page pourquoi doc & moi
    public function pourquoiDoc()
    {
        return view('front.pages.pourquoi_doc');
    }

    public function accessibilite()
    {
        return view('front.pages.accessibilite');
    }

    public function politiqueDeConfidentialite()
    {
        return view('front.pages.politique_de_confidentialite');
    }


    /*
     * La page du tableau de bord
     * Selon le type d'utilisateur, un tableau de bord est affiché
     */
    public function dashboard()
    {
        if (Session::has('user')) {
            return PatientController::dashboard();
        } else if (Session::has('hopital')) {
            return HopitalController::dashboard();
        } else if (Session::has('medecin')) {
            return MedecinController::dashboard();

        } else if (Session::has('admin')) {
            $medecinsA = Medecin::get();
            $rdvA = Rdv::get();
            $hopitalA = Hopital::get();
            return view('back.pages.dashboard')->with('medecinsA', count($medecinsA))
                ->with('rdvA', count($rdvA))
                ->with('hopitalA', count($hopitalA));
        } else {
            abort(404);
        }
    }


    // Affichage de la page d'inscription
    public function inscriptionView()
    {
        if (!(Session::has('admin')) && !(Session::has('medecin')) && !(Session::has('user')) && !(Session::has('hopital'))) {
            return view('front.pages.inscription');
        } else {
            return redirect("/");
        }
    }

    // Affichage de la page de connexion
    public function connexionView()
    {

        if (!(Session::has('admin')) && !(Session::has('medecin')) && !(Session::has('user')) && !(Session::has('hopital'))) {
            return view('front.pages.connexion');
        } else {

            return redirect("/");
        }
    }


    /*
     * Inscription des utilisateurs
     */
    public function inscription(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'user_type' => 'required',
                'email' => 'required',
                'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'mot_de_passe' => 'required|min:8',
                'c_mot_de_passe' => 'required|min:8'
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->c_mot_de_passe != $request->mot_de_passe) {
            $validator->errors()->add("c_mot_de_passe", "Le mot de passe est incorrect");
            return back()->withErrors($validator)->withInput();
        }

        /*
         * Selon le type d'utilisateur l'inscription est faite
         */
        try {
            $type = $request->user_type;
            switch ($type) {
                case 'hopital':
                    return HopitalController::inscription($request);
                    break;
                case 'medecin':
                    return MedecinController::inscription($request);
                    break;
                case 'utilisateur':
                    return PatientController::inscription($request);
                    break;
                default:
                    Session::put('fail', 'Une erreur s\'est produite. Veuillez vérifier vos informations.');
                    return redirect()->back();
                    break;
            }
        } catch (\ Exception $e) {
            Session::put('fail', 'Une erreur s\'est produite. Veuillez vérifier vos informations.');
            return redirect()->back();
        }
    }

    /*
    * Connexion des utilisateurs
    */
    public function connexion(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'user_type' => 'required',
                'email' => 'required',
                'mot_de_passe' => 'required|min:8',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        /*
         * Selon le type d'utilisateur la connexion est faite
         */
        try {
            $type = $request->user_type;
            switch ($type) {
                case 'hopital':
                    return HopitalController::connexion($request);
                    break;
                case 'medecin':
                    return MedecinController::connexion($request);
                    break;
                case 'utilisateur':
                    return PatientController::connexion($request);
                    break;
                default:
                    Session::put('fail', 'Une erreur s\'est produite. Veuillez vérifier vos informations.');
                    return redirect()->back();
                    break;
            }
        } catch (\ Exception $e) {
            Session::put('fail', 'Une erreur s\'est produite. Veuillez vérifier vos informations.');
            return redirect()->back();
        }
    }

    /*
    * Deconnexion des utilisateurs
    */
    public function logout()
    {

        Session::put('user', null);
        Session::put('medecin', null);
        Session::put('hopital', null);
        Session::put('admin', null);
        return redirect('/');
    }


    // Affichage de la page des paramètres selon le type d'utilisateur
    public function parametreView()
    {

        if (Session::has('user') || Session::has('hopital')) {
            return view('back.pages.parametre');
        } else {
            if (Session::has('medecin')) {
                return MedecinController::parametreView();
            }
        }
        abort(404);

    }


    // Retourner un medecin en fonction de son id
    public function medecin($id)
    {
        return MedecinController::medecin($id);
    }

    // Retourner un hôpital en fonction de son id
    public function hopital($id)
    {
        return HopitalController::getHopital($id);
    }

    // Retourner tous les medecins
    public function getMedecins()
    {
        return MedecinController::getMedecins();
    }


    // Retourner les prochains rdv selon le type d'utilisateur
    public function rdvProchains()
    {
        if (Session::has('medecin')) {
            return MedecinController::rdvProchains();
        } else {
            if (Session::has('user')) {
                return PatientController::rdvProchains();
            } else {
                if (Session::has('hopital')) {
                    return HopitalController::rdvProchains();
                } else {
                    abort(404);
                }
            }
        }
    }

    // Retourner les rdv dejà passés selon le type d'utilisateur
    public function rdvPasses()
    {
        if (Session::has('medecin')) {
            return MedecinController::rdvPasses();
        } else {
            if (Session::has('user')) {
                return PatientController::rdvPasses();
            } else {
                if (Session::has('hopital')) {
                    return HopitalController::rdvPasses();
                } else {
                    abort(404);
                }
            }
        }
    }

    /*
     * Mot de passe oublié
     * On génère un token aléatoirement qui sera valable 1h, l'utilisateur recevra un mail pour modifier son mot de passe
     */
    public function forgot(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'user_type' => 'required',
                'email' => 'required',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        try {
            $type = $request->user_type;
            $token = PasswordResetsController::insert($request);
            switch ($type) {
                case 'hopital':
                    return HopitalController::forgot($request, $token);
                    break;
                case 'medecin':
                    return MedecinController::forgot($request, $token);
                    break;
                case 'utilisateur':
                    return PatientController::forgot($request, $token);
                    break;
            }
        } catch (\ Exception $e) {
            Session::put('fail', 'Une erreur s\'est produite. Veuillez vérifier vos informations.');
            return redirect()->back();
        }
    }

}
