@extends('back.layouts.app')
@section('title-1')
    Hôpital
@endsection

@section('content')

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Détail hôpital</div>

            <div class="row detail">

                <div class="col-sm-3">

                    <img class="profil" src="{{ isset($hopital->img) ? asset('front/img/hopitaux/'.$hopital->img) : asset('front/img/avatar.png') }}" alt="">
                </div>

                <div class="col-sm-9">
                        <div class="row info">
                            <div class="col-sm-3">
                                <h5>Libbelé</h5>
                            </div>
                            <div class="col-sm-9 ">
                                 <h5 class="content">{{ $hopital->libelle }}</h5>
                            </div>
                        </div>
                        <div class="row info">
                            <div class="col-sm-3">
                                <h5>Email</h5>
                            </div>
                            <div class="col-sm-9 content">
                                 <h5 class="content">{{ $hopital->email }}</h5>
                            </div>
                        </div>
                        <div class="row info">
                            <div class="col-sm-3">
                                <h5>Téléphone</h5>
                            </div>
                            <div class="col-sm-9 content">
                                 <h5 class="content">{{ $hopital->telephone }}</h5>
                            </div>
                        </div>



                        <div class="row info">
                            <div class="col-sm-3">
                                <h5>Spécialités</h5>
                            </div>
                            <div class="col-sm-9 content">
                                @foreach ($specialites as $specialite)
                                    <h5 class="content">{{ $specialite->libelle }}</h5>

                                @endforeach
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
