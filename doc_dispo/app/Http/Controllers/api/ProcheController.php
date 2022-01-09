<?php

namespace App\Http\Controllers\api;
use App\Models\Proche;
use Illuminate\Http\Request;

use Validator;

class ProcheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Proche::get(), 200);
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
            'nom' => 'required',
            'prenom' => 'required',
            'telephone' => 'required',
            'date_naissance' => 'required',
            'sexe' => 'required',
            'id_patient' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $proche = Proche::create($request->all());
        return response()->json($proche, 201);
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
        $proche = Proche::find($id);
        if(is_null($proche))
        {
            return response()->json(["message" => "Record not found"], 404);
        }
        $proche->update($request->all());
        return response()->json($proche, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proche = Proche::find($id);
        if(is_null($proche))
        {
            return response()->json(["message" => "Record not found"], 404);
        }
        $proche->delete();
        return response()->json(null, 204);
    }
}
