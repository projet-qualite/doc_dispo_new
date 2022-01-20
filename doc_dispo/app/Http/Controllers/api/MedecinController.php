<?php

namespace App\Http\Controllers\api;
use App\Models\Medecin;
use Illuminate\Http\Request;
use Validator;

class MedecinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Medecin::where('etat_compte', 1)->orderBy('nom')->get(), 200);
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


    public function connexion($email, $mdp)
    {
        $medecin = Medecin::where('email', $email)->where('mdp', sha1($mdp))->first();
        if(is_null($medecin))
        {
            return response()->json(null, 404);
        }
        else{
            return response()->json($medecin, 200);
        }
    }

    public function updatePassword($ancien, $nouveau, $id)
    {
        $medecin = Medecin::find($id);
        if(is_null($medecin))
        {
            return response()->json(null, 404);
        }
        else{
            if(sha1($ancien) == $medecin->mdp)
            {
                $medecin->mdp = sha1($nouveau);
                $medecin->update();
                return response()->json($medecin, 200);
            }
            else{
                return response()->json(null, 400);
            }
        }
    }

    public function updateTelephone($telephone, $id)
    {
        $medecin = Medecin::find($id);
        if(is_null($medecin))
        {
            return response()->json(null, 404);
        }
        else{
            $medecin->telephone = $telephone;
            $medecin->update();
            return response()->json($medecin, 200);
        }
    }

    public function updateEmail($email, $id)
    {
        $medecin = Medecin::find($id);
        if(is_null($medecin))
        {
            return response()->json(null, 404);
        }
        else{
            $medecin->email = $email;
            $medecin->update();
            return response()->json($medecin, 200);
        }
    }
}
