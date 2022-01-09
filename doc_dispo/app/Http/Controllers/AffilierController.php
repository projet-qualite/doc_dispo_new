<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Affilier;
use Session;
use Validator;

class AffilierController extends Controller
{
    //


    public function ajouter(Request $request)
    {
        try{
            if(Session::has('hopital'))
            {
                $validator = Validator::make($request->all(),
                    [
                            'assurance' => 'required',
                    ]
                );

                if($validator->fails())
                {
                    return back()->withErrors($validator)->withInput();
                }

                //dd($request->assurance);

                $affilierExist = Affilier::where('id_hopital', Session::get('hopital')->id)
                                ->where('id_assurance', $request->assurance)
                                ->get()
                                ->first();

                if(is_null($affilierExist))
                {
                    $affilier = new Affilier();
                    $affilier->id_hopital = Session::get('hopital')->id;
                    $affilier->id_assurance = $request->assurance;
                    $affilier->save();
                    Session::put('success', 'Affiliation réussie');

                    return redirect()->back();
                }
                else{
                    Session::put('fail', 'Affiliation déjà existe.');
                    return redirect()->back();
                }


            }
            abort(404);
        }
        catch(\ Exception $e)
        {
            // Renvoie un message si une exception a été lancée
            Session::put('fail', 'Affiliation échouée. Veuillez saisir correctement les informations. ');
            return redirect()->back();
        }
    }

    public function test()
    {
        return response()->json(Affilier::get(), 200);
    }


    public function supprimer($id_affilier)
    {
        try{
            if(Session::has('admin') || Session::has('hopital'))
            {
                $affilier = Affilier::find($id_affilier);
                $affilier->delete();
                Session::put('success_', 'Affilitation supprimée.');
                return redirect()->back();
            }
            abort(404);

        }
        catch(\ Exception $e)
        {
            // Renvoie un message si une exception a été lancée
            Session::put('fail_', 'Une érreur s\'est produite');
            return redirect()->back();
        }
    }
}
