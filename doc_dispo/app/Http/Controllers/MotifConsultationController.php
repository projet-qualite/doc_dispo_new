<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\Motif;
use App\Models\MotifConsultation;
use Illuminate\Http\Request;
use Validator;
use Session;
use DB;

class MotifConsultationController extends Controller
{
    //

    // Vue pour l'ajout d'un motif de consultation
    public function ajouterMotifConsultationView()
    {
        if(Session::has('medecin'))
        {
            $motifsMedecin = DB::table('motif_consultation')
                            ->join('motif', 'motif.id', '=', 'motif_consultation.id_motif')
                            ->select('motif.*', 'motif_consultation.id_medecin', 'motif_consultation.id AS id_consultation')
                            ->where('motif_consultation.id_medecin', Session::get('medecin')->id)
                            ->get();

            return view('back.pages.motifs_consutation')
            ->with('motifs', Motif::get())
            ->with('motifs_m', $motifsMedecin);
        }
        abort(404);
    }


    // Ajout d'un motif de consultation
    public function ajouter(Request $request)
    {
        try{
            if(Session::has('medecin'))
            {
                $validator = Validator::make($request->all(),
                    [
                            'motif' => 'required',
                    ]
                );

                if($validator->fails())
                {
                    return back()->withErrors($validator)->withInput();
                }


                $motifExist = MotifConsultation::where('id_medecin', Session::get('medecin')->id)
                                ->where('id_motif', $request->motif)
                                ->get()
                                ->first();

                if(is_null($motifExist))
                {
                    $motif = new MotifConsultation();
                    $motif->id_medecin = Session::get('medecin')->id;
                    $motif->id_motif = $request->motif;
                    $motif->save();
                    Session::put('success', 'Ajout r??ussi');

                    return redirect()->back();
                }
                else{
                    Session::put('fail', 'Motif d??j?? existant.');
                    return redirect()->back();
                }


            }
            abort(404);
        }
        catch(\ Exception $e)
        {
            // Renvoie un message si une exception a ??t?? lanc??e
            Session::put('fail', 'Ajout motif ??chou??e. Veuillez saisir correctement les informations. ');
            return redirect()->back();
        }
    }


    public function supprimer($id_motif_consultation)
    {
        try{
            if(Session::has('medecin'))
            {
                $motif = MotifConsultation::find($id_motif_consultation);
                if($motif->id_medecin == Session::get('medecin')->id)
                {
                    $motif->delete();
                    Session::put('success_', 'Motif de consultation supprim??e.');
                    return redirect()->back();
                }
                abort(404);

            }
            abort(404);

        }
        catch(\ Exception $e)
        {
            // Renvoie un message si une exception a ??t?? lanc??e
            Session::put('fail_', 'Une ??rreur s\'est produite');
            return redirect()->back();
        }
    }
}
