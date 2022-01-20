<?php

namespace App\Http\Controllers\api;

use App\Models\Creneau;
use Illuminate\Http\Request;
use Validator;
use DB;

class CreneauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $creneauxQuery = Creneau::where('etat', 0)
            ->orderBy(DB::raw("CONVERT(jour, DATETIME)"), 'asc')
            ->orderBy(DB::raw("CONVERT(heure, DOUBLE)"), 'asc')
            ->get();

        $creneaux = [];
        foreach ($creneauxQuery as $creneau)
        {
            $concat = $creneau->jour." ".$creneau->heure;
            $timestamp = strtotime($concat);
            if($timestamp > time())
            {
                $creneaux [] = $creneau;
            }
        }
        return response()->json($creneaux, 200);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'jour' => 'required',
            'heure' => 'required',
            'etat' => 'required',
            'id_motif_consult' => 'required',
            'id_medecin' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try{
            $creneau = Creneau::create($request->all());
            return response()->json($creneau, 201);

        }catch (\ Exception $e) {
            // Renvoie un message si une exception a été lancée
            return response()->json(null, 404);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $creneau = Creneau::find($id);
        if(!is_null($creneau))
        {
            return response()->json($creneau, 200);
        }
        else{
            return response()->json(null, 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $creneau = Creneau::find($id);
            $creneau->delete();
            return response()->json(null, 200);


        } catch (\ Exception $e) {
            // Renvoie un message si une exception a été lancée
            return response()->json($creneau, 400);
        }

    }


    public function allCreneaux()
    {
        return response()->json(Creneau::get(), 200);
    }
}
