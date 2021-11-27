<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Validator;
use Session;

class AdminController extends Controller
{
    //

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
}
