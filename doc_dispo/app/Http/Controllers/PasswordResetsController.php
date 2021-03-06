<?php

namespace App\Http\Controllers;

use App\Models\PasswordResets;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Session;
use Validator;

class PasswordResetsController extends Controller
{

    /*
     * Ajout d'une demande de réinitialisation de mot de passe
     * Génération d'un token valable 1h
     */
    public static function insert(Request $request)
    {
        try {
            $password = new PasswordResets();
            $password->type = $request->user_type;
            $password->email = $request->email;
            $password->token = Str::random(32);
            $password->date = time();
            $password->expire_date = time() + 3600;
            $password->valid = 1;


            $already_exist = PasswordResets::where('token', $password->token)->first();


            if(is_null($already_exist)) {
                $password->save();
            } else {
                while (!(is_null($already_exist))) {
                    $password->token = Str::random(32);
                    $already_exist = PasswordResets::where('token', $password->token)->first();
                }
                $password->save();
            }

            return $password->token;


        } catch (\ Exception $e) {
            Session::put('fail', 'Inscription échouée. Veuillez saisir correctement les informations. ');
        }
    }


    /*
     * Affichage de la page pour la réintialisation du mot de passe
     * On vérifie que l'insertion est toujours valide ainsi que le token n'a pas expiré
     */
    public function reset($token, $email)
    {
        $password = PasswordResets::where("token", $token)->where("email", $email)->first();
        if(is_null($password))
        {
            abort(404);
        }
        else {
            if($password->valid == 0 || time() > $password->expire_date)
            {
                abort(404);
            }
            else{
                return view('front.pages.reset')->with("token", $token)->with("email", $email);
            }
        }

    }

    public function resetUpdate(Request $request, $token, $email)
    {
        $validator = Validator::make($request->all(),
            [
                'mot_de_passe' => 'required|min:8',
                'c_mot_de_passe' => 'required|min:8',
            ]
        );

        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        if($request->mot_de_passe != $request->c_mot_de_passe)
        {
            $validator->errors()->add("c_mot_de_passe", "Le mot de passe est différent");
            return back()->withErrors($validator)->withInput();
        }

        $password = PasswordResets::where("token", $token)->where("email", $email)->first();
        if(is_null($password))
        {
            abort(404);
        }
        else{
            $password->valid = 0;
            $password->update();

            switch($password->type)
            {
                case 'hopital':
                    return HopitalController::resetUpdate($request, $email);
                    break;
                case 'medecin':
                    return MedecinController::resetUpdate($request, $email);
                    break;
                case 'utilisateur':
                    return PatientController::resetUpdate($request, $email);
                    break;
                default:
                    Session::put('fail', 'Une erreur s\'est produite. Veuillez vérifier vos informations.');
                    return redirect()->back();
                    break;
            }
        }
        Session::put('success', 'Mot de passe réinitialisé avec succès');
        return redirect()->back();
    }
}
