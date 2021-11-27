<?php

namespace App\Http\Controllers;

use App\Models\Assurance;
use App\Models\Medecin;
use App\Models\Hopital;
use App\Models\Specialite;
use App\Models\Rdv;
use Illuminate\Http\Request;
use Session;
use Validator;

use DB;

class UsersController extends Controller
{
    //

    public function homepage()
    {
        $medecins = Medecin::where('etat_compte', 1)->get();
        $specialites = Specialite::orderBy('libelle', 'asc')->get();
        $hopitaux = Hopital::where('etat_compte', 1)->get();
        $assurances = Assurance::get();

        return view('front.pages.home')->with('medecins', $medecins)
                                        ->with('hopitaux', $hopitaux)
                                        ->with('specialites', $specialites)
                                        ->with('assurances', $assurances);
    }

    public function partenaires()
    {
        return view('front.pages.partenaires');
    }

    public function commentCaMarche()
    {
        return view('front.pages.how_it_works');
    }

    public function pourquoiDoc()
    {
        return view('front.pages.pourquoi_doc');
    }


    public function dashboard()
    {
        if(Session::has('user'))
        {
            return PatientController::dashboard();
        }
        else if(Session::has('hopital'))
        {
            return HopitalController::dashboard();
        }
        else if(Session::has('medecin'))
        {
            return MedecinController::dashboard();
            
        }
        else if(Session::has('admin'))
        {
            $medecinsA = Medecin::get();
            $rdvA = Rdv::get();
            $hopitalA = Hopital::get();
            return view('back.pages.dashboard')->with('medecinsA', count($medecinsA))
            ->with('rdvA', count($rdvA))
            ->with('hopitalA', count($hopitalA));
        }
        else{
            abort(404);
        }
    }



    public function inscriptionView()
    {
        if(!(Session::has('admin')) && !(Session::has('medecin')) && !(Session::has('user')))
        {
            return view('front.pages.inscription');
        }
        else{
            redirect("/");
        }
    }


    public function connexionView()
    {
        
        if(!(Session::has('admin')) && !(Session::has('medecin')) && !(Session::has('user')))
        {
            return view('front.pages.connexion');
            //dd("YO");
        }
        else{
            //dd("YO");
            return redirect("/");
        }
    }


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

        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }


        try{
            $type = $request->user_type;
            switch($type)
            {
                case 'hopital':
                    return HopitalController::inscription($request);
                    break;
                case 'medecin':
                    return MedecinController::inscription($request);
                    break;
                case 'utilisateur':
                    return PatientController::inscription($request);
                    break;
                case 'utilisateur':
                    return PatientController::connexion($request);
                    break;
                default:
                    Session::put('fail', 'Une erreur s\'est produite. Veuillez vérifier vos informations.');
                    return redirect()->back();
                    break;
            }
        }
        catch(\ Exception $e)
        {
            Session::put('fail', 'Une erreur s\'est produite. Veuillez vérifier vos informations.');
            return redirect()->back();
        } 
    }


    public function connexion(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'user_type' => 'required',
                'email' => 'required',
                'mot_de_passe' => 'required|min:8',
            ]
        ); 

        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }


        try{
            $type = $request->user_type;
            switch($type)
            {
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
        }
        catch(\ Exception $e)
        {
            Session::put('fail', 'Une erreur s\'est produite. Veuillez vérifier vos informations.');
            return redirect()->back();
        } 
    }


    public function logout(){

        Session::put('user', null);
        Session::put('medecin', null);
        Session::put('hopital', null);
        Session::put('admin', null);
        return redirect('/');
    }


    public function parametreView()
    {
        
        if(Session::has('user') || Session::has('hopital'))
        {
            return view('back.pages.parametre');
        }
        else{
            if(Session::has('medecin'))
            {
                return MedecinController::parametreView();
            }
        }
        abort(404);
    
    }



    public function medecin($id)
    {
        return MedecinController::medecin($id);
    }



    public function hopital($id)
    {
        return HopitalController::getHopital($id);
    }


    public function getMedecins(){
        return MedecinController::getMedecins();
    }
    

    public function rdvProchains()
    {
        if(Session::has('medecin'))
        {
            return MedecinController::rdvProchains();
        }
        else{
            if(Session::has('user'))
            {
                return PatientController::rdvProchains();
            }
            else{
                if(Session::has('hopital'))
                {
                    return HopitalController::rdvProchains();
                }
                else{
                    abort(404);
                }
            }
        }
    }


    public function rdvPasses()
    {
        if(Session::has('medecin'))
        {
            return MedecinController::rdvPasses();
        }
        else{
            if(Session::has('user'))
            {
                return PatientController::rdvPasses();
            }
            else{
                if(Session::has('hopital'))
                {
                    return HopitalController::rdvPasses();
                }
                else{
                    abort(404);
                }
            }
        }
    }

    
}
