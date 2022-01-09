<?php

namespace App\Http\Controllers\api;
use App\Models\Patient;
use Illuminate\Http\Request;
use DB;
use Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Patient::get(), 200);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proches = Proche::where('id_patient', $id)->get();

        return response()->json($proches, 200);
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


    public function connexion($email, $mdp)
    {
        $patient = Patient::where('email', $email)->where('mdp', sha1($mdp))->first();
        if(is_null($patient))
        {
            return response()->json(null, 404);
        }
        else{
            return response()->json($patient, 200);
        }
    }

    public function inscription(Request $request)
    {
        $rules = [
            'email' => 'required',
            'mdp' => 'required|min:8'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $patient = Patient::where('email', $request->email)->first();



        if(is_null($patient))
        {
            $data = $request->all();
            $data['mdp'] = sha1($request->mdp);
            $patient = Patient::create($data);
            $patient_cree = Patient::where('email', $data["email"])->where('mdp', $data["mdp"])->first();
            return response()->json($patient_cree, 201);
        }
        else{
            return response()->json(null, 400);
        }
    }

    public function updatePassword($ancien, $nouveau, $id)
    {
        $patient = Patient::find($id);
        if(is_null($patient))
        {
            return response()->json(null, 404);
        }
        else{
            if(sha1($ancien) == $patient->mdp)
            {
                $patient->mdp = sha1($nouveau);
                $patient->update();
                return response()->json($patient, 200);
            }
            else{
                return response()->json(null, 400);
            }
        }
    }

    public function updateTelephone($telephone, $id)
    {
        $patient = Patient::find($id);
        if(is_null($patient))
        {
            return response()->json(null, 404);
        }
        else{
            $patient->telephone = $telephone;
            $patient->update();
            return response()->json($patient, 200);
        }
    }

    public function updateEmail($email, $id)
    {
        $patient = Patient::find($id);
        if(is_null($patient))
        {
            return response()->json(null, 404);
        }
        else{
            $patient->email = $email;
            $patient->update();
            return response()->json($patient, 200);
        }
    }
}
