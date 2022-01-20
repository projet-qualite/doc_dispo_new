@extends('back.layouts.app')
@section('title-1')
    Medecins
@endsection

@section('content')

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Détail medecin</div>

            <div class="row detail">

                <div class="col-sm-3">

                    <img class="profil" src="{{ isset($medecin->img_1) ? asset('front/img/medecins/'.$medecin->img_1) : asset('front/img/avatar.png') }}" alt="">
                </div>

                <div class="col-sm-9">
                        <div class="row info">
                            <div class="col-sm-3">
                                <h5>Nom</h5>
                            </div>
                            <div class="col-sm-9 ">
                                 <h5 class="content">{{ $medecin->nom }}</h5>
                            </div>
                        </div>
                        <div class="row info">
                            <div class="col-sm-3">
                                <h5>Prenom</h5>
                            </div>
                            <div class="col-sm-9 content">
                                 <h5 class="content">{{ $medecin->prenom }}</h5>
                            </div>
                        </div>
                        <div class="row info">
                            <div class="col-sm-3">
                                <h5>Email</h5>
                            </div>
                            <div class="col-sm-9 content">
                                 <h5 class="content">{{ $medecin->email }}</h5>
                            </div>
                        </div>
                        <div class="row info">
                            <div class="col-sm-3">
                                <h5>Téléphone</h5>
                            </div>
                            <div class="col-sm-9 content">
                                 <h5 class="content">{{ $medecin->telephone }}</h5>
                            </div>
                        </div>
                        <div class="row info">
                            <div class="col-sm-3">
                                <h5>Genre</h5>
                            </div>
                            <div class="col-sm-9 content">
                                @if (isset($medecin->sexe))
                                    @if ($medecin->sexe == "m")
                                        <h5 class="content">Masculin</h5>
                                    @else
                                        <h5 class="content">Feminin</h5>
                                    @endif
                                @else
                                    <h5 class="content">Non défini</h5>
                                @endif
                            </div>
                        </div>
                        <div class="row info">
                            <div class="col-sm-3">
                                <h5>Type</h5>
                            </div>
                            <div class="col-sm-9 content">
                                 <h5 class="content">{{ (isset($medecin->type)) ? $medecin->type : 'Non défini'  }}</h5>
                            </div>
                        </div>
                        <div class="row info">
                            <div class="col-sm-3">
                                <h5>Spécialité</h5>
                            </div>
                            <div class="col-sm-9 content">
                                 <h5 class="content">{{ (isset($medecin->specialite)) ? $medecin->specialite : 'Non défini'  }}</h5>
                            </div>
                        </div>


                    <div class="row info">
                        <div class="col-sm-3">
                            <h5>Biographie</h5>
                        </div>
                        <div class="col-sm-9 content">
                            <h5 class="content">{{ (isset($medecin->biographie)) ? $medecin->biographie : 'Non défini'  }}</h5>
                        </div>
                    </div>
                </div>







            </div>

        </div>
      </div>
	  <!-- /tables-->
	  </div>
	  <!-- /container-fluid-->
   	</div>
@stop
