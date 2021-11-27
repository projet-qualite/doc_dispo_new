@extends('back.layouts.app')
@section('title-1')
    Medecins
@endsection
@section('title-2')
   Liste des medecins
@endsection

@section('content')

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des medecins</div>
        <div class="card-body">
            @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
                {{ Session::put('success', null) }}
            </div>
            @endif

            @if (Session::has('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
                {{ Session::put('fail', null) }}
            </div>
            @endif
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Etat compte</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($medecins as $medecin)
                    <tr>
                        <td>
                            {{ $medecin->nom }}
                        </td>
                        <td>
                            {{ $medecin->prenom }}
                        </td>
                        <td>
                            {{ $medecin->email }}
                        </td>
                        <td>
                            {{ $medecin->telephone }}
                        </td>
                        <td>
                            {{ ($medecin->etat_compte == 0) ? 'Activé' : 'Désactivé' }}
                        </td>
                     
                       
                        <td style="display: flex; justify-content: center; align-content: center">
                            @if (($medecin->etat_compte == 0))
                                <a href="{{ URL::to('/state-medecin/'.$medecin->id.'/1') }}" class="nav-link btn btn-success">
                                    Activer le compte
                                </a>
                            @else
                                <a href="{{ URL::to('/state-medecin/'.$medecin->id.'/0') }}" class="nav-link  btn btn-danger">
                                    Désactiver le compte
                                </a>
                            @endif
                            
                           
                         
                           
                        </td>
                       
                      
                       
                    </tr>
                      
                  @endforeach
                  
              </tbody>
            </table>
          </div>
        </div>
      </div>
	  <!-- /tables-->
	  </div>
	  <!-- /container-fluid-->
   	</div>
@stop