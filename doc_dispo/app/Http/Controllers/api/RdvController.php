<?php

namespace App\Http\Controllers\api;
use App\Mail\MailRdv;
use App\Models\Creneau;
use App\Models\Medecin;
use App\Models\Patient;
use App\Models\Proche;
use App\Models\Rdv;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Validator;
use DB;

class RdvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rdvsPa = DB::table('rdv')
            ->join('creneau', 'creneau.id', '=', 'rdv.id_creneau')
            ->join('medecin', 'medecin.id', '=', 'creneau.id_medecin')
            ->join('specialite', 'specialite.id', '=', 'medecin.id_specialite')
            ->join('hopital', 'hopital.id', '=', 'medecin.id_hopital')
            ->join('proche', 'proche.id', '=', 'rdv.id_proche')
            ->select(
                'creneau.jour as jour',
                'creneau.heure as heure',
                'rdv.*'
            )
            ->orderBy(DB::raw("CONVERT(jour, DATETIME)"), 'desc')
            ->orderBy(DB::raw("CONVERT(heure, DOUBLE)"), 'desc')
            ->get();


        $rdvsPasses = [];

        foreach ($rdvsPa as $rdv)
        {
            $concat = $rdv->jour." ".$rdv->heure;
            $timestamp = strtotime($concat);
            if($timestamp <= time())
            {
                $rdvsPasses [] = $rdv;
            }

        }


        $rdvsPro = DB::table('rdv')
            ->join('creneau', 'creneau.id', '=', 'rdv.id_creneau')
            ->join('medecin', 'medecin.id', '=', 'creneau.id_medecin')
            ->join('specialite', 'specialite.id', '=', 'medecin.id_specialite')
            ->join('hopital', 'hopital.id', '=', 'medecin.id_hopital')
            ->join('proche', 'proche.id', '=', 'rdv.id_proche')
            ->select(
                'creneau.jour as jour',
                'creneau.heure as heure',
                'rdv.*'
            )
            ->orderBy(DB::raw("CONVERT(jour, DATETIME)"), 'asc')
            ->orderBy(DB::raw("CONVERT(heure, DOUBLE)"), 'asc')
            ->get();


        $rdvsProchains = [];

        foreach ($rdvsPro as $rdv)
        {
            $concat = $rdv->jour." ".$rdv->heure;
            $timestamp = strtotime($concat);
            if($timestamp >= time())
            {
                $rdvsProchains [] = $rdv;
            }

        }

        return response()->json([$rdvsProchains, $rdvsPasses], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'etat' => 'required',
            'id_creneau' => 'required',
            'id_proche' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $creneau = Creneau::find($request->id_creneau);
        if($creneau->etat == 1)
        {
            return response()->json(["message" => "Ce créneau est déjà pris"], 404);
        }
        else{
            setlocale(LC_TIME, "fr_FR");
            date_default_timezone_set('Europe/Paris');

            $message = "Votre rendez-vous est prévu le : <strong>". strftime("%A%e %B %Y", strtotime($creneau->jour))." à ".$creneau->heure."</strong>";
            $informations = ["Rappel rendez-vous", $message];
            Mail::to(Patient::where('id', Proche::find($request->id_proche)->id_patient)->first()->email)->send(new MailRdv($informations));
            Mail::to(Medecin::where('id', $creneau->id_medecin)->first()->email)->send(new MailRdv($informations));

            $rdv = Rdv::create($request->all());
            $creneau->etat = 1;
            $creneau->update();
            return response()->json($rdv, 201);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*$rdv = Rdv::find($id);
        if(is_null($rdv))
        {
            return response()->json(["message" => "Record not found"], 404);
        }
        $rdv->update($request->all());
        return response()->json($rdv, 200);*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rdv = Rdv::find($id);
        if(is_null($rdv))
        {
            return response()->json(["message" => "Record not found"], 404);
        }
        $creneau = Creneau::find($rdv->id_creneau);
        $date_creneau = $creneau->jour." ".$creneau->heure;
        $timeStamp = strtotime($date_creneau);

        /*
         * Un rdv ne peut être annulé qu'au plus tard 2h avant
         */
        if(($timeStamp - time()) <= 2*60*60 )
        {
            return response()->json(null, 403);
        }
        setlocale(LC_TIME, "fr_FR");
        date_default_timezone_set('Europe/Paris');
        $message = "Votre rendez-vous prévu le : <strong>". strftime("%A%e %B %Y", strtotime($creneau->jour))." à ".$creneau->heure."</strong> a été annulé";
        $informations = ["Annulation de rendez-vous", $message];
        Mail::to(Patient::where('id', Proche::find($rdv->id_proche)->id_patient)->first()->email)->send(new MailRdv($informations));
        Mail::to(Medecin::where('id', $creneau->id_medecin)->first()->email)->send(new MailRdv($informations));
        $creneau->etat = 1;
        $creneau->update();
        $rdv->delete();
        return response()->json(null, 204);
    }
}
