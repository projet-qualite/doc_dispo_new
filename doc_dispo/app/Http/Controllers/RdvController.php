<?php

namespace App\Http\Controllers;

use App\Models\Rdv;
use App\Models\Creneau;
use Illuminate\Http\Request;

use Session;
use DB;

class RdvController extends Controller
{
    //

    public function ajouter(Request $request, $id_medecin)
    {
        if(Session::has('user'))
        {
            try{
                $rdv = new Rdv();
                $rdv->id_proche = $request->proche;
                $rdv->id_creneau = $request->id_creneau;
        
                $creneau = Creneau::find($request->id_creneau);
                $creneau->etat = 1;
                $creneau->update();
        
                $rdv->save();
                Session::put('success', 'Le rendez vous a été pris avec succès');
                return redirect()->back();
           }
            catch(\ Exception $e)
            {
                Session::put('fail', 'Une erreur s\'est produite ');
                return redirect()->back();
            } 
        }
        abort(404);
        
    }


    public function supprimer($id)
    {
        if(Session::has('user'))
        {
            try{
                
                $rdv = Rdv::where('slug', $id)->first();

                $creneau = Creneau::find($rdv->id_creneau);

                $creneau->etat = 0;
                $creneau->update();
                $rdv->delete();

                Session::put('success', 'Le rendez vous a été annulé avec succès');
                return redirect()->back();
            }
            catch(\ Exception $e)
            {
                Session::put('fail', 'Une erreur s\'est produite ');
                return redirect()->back();
            } 
        }
        abort(404);
    }
}
