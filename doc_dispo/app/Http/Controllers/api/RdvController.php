<?php

namespace App\Http\Controllers\api;
use App\Models\Creneau;
use App\Models\Rdv;
use Illuminate\Http\Request;

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
        $rdvsProchains = DB::table('rdv')
            ->join('creneau', 'creneau.id', '=', 'rdv.id_creneau')
            ->select(
                'rdv.*',
            )
            ->whereDate('creneau.jour', '>=', date('Y-m-d'))
            ->whereTime('creneau.heure', '>=', date('H.i'))
            ->orderBy('creneau.jour', 'ASC')
            ->orderBy(DB::raw('HOUR(creneau.heure)'))
            ->get();


        $rdvsPasses = DB::table('rdv')
            ->join('creneau', 'creneau.id', '=', 'rdv.id_creneau')
            ->select(
                'rdv.*',
            )
            ->whereDate('creneau.jour', '>=', date('Y-m-d'))
            ->whereTime('creneau.heure', '>=', date('H.i'))
            ->orderBy('jour', 'DESC')
            ->get();
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
        $creneau->etat = 1;
        $creneau->update();
        $rdv->delete();
        return response()->json(null, 204);
    }
}
