<?php

namespace App\Http\Controllers\api;
use App\Models\Creneau;
use Illuminate\Http\Request;
use Validator;

class CreneauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $creneaux = Creneau::where('etat', 0)
                    ->whereDate('jour', '>=', date('Y-m-d'))
                    ->whereTime('heure', '>=', date('H.i'))
                    ->orderBy('jour', 'ASC')
                    ->orderBy('heure', 'ASC')
                    ->get();
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
     * @param  \Illuminate\Http\Request  $request
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
        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $creneau = Creneau::create($request->all());
        return response()->json($creneau, 201);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
