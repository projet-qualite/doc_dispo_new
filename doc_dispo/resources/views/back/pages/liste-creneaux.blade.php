@extends('back.layouts.app')
@section('title-1')
    Créneaux
@endsection
@section('title-2')
   Liste des créneaux
@endsection

@section('content')

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des créneaux</div>
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
                    <th>Date créneau</th>
                    <th>Heure créneau</th>
                    <th>Specialité</th>
                    <th>Hopital</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($creneaux as $creneau)
                    <tr>
                        <td>
                            {{ $creneau->date_creneau }}
                        </td>
                        <td>
                            {{ $creneau->heure_creneau }}
                        </td>
                        <td>
                            {{ $creneau->libelle_specialite }}
                        </td>
                        <td>
                            {{ $creneau->libelle_hopital }}
                        </td>
                      
                        <td style="display: flex; justify-content: center; align-content: center">
                           
                            <a class="nav-link" data-toggle="modal" data-target="#delete">
                                <i class="fa fa-trash fa-2x" style="margin-right: 10px"></i>
                            </li>
                            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Voulez vous supprimer ce créneau ?</h5>
                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                      </button>
                                    </div>
                                    <div class="modal-footer">
                                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                                      <a class="btn btn-primary" href="{{ URL::to('/delete-creneau/'.$creneau->id) }}">Confirmer</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
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