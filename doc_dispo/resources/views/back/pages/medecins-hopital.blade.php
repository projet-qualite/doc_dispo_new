@extends('back.layouts.app')
@section('title-1')
    Medecins
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
                    <th>Telephone</th>
                    <th>Actions</th>
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
                            {{ $medecin->telephone }}
                        </td>
                        <td style="display: flex; justify-content: center;">
                          
                          @if ($medecin->etat_compte == 0)

                          

                          <a class="" data-toggle="modal" data-target="#delete{{ $medecin->id }}">
                            <ion-icon name="checkbox-outline" style="color: green"></ion-icon>
                          </li>
                          <div class="modal fade" id="delete{{ $medecin->id }}" tabindex="-1" role="dialog" aria-labelledby="delete{{ $medecin->id }}" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Voulez vous activer ce compte ?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Non </button>
                                    <a class="btn btn-primary" href="{{ URL::to('/activer-medecin/'.$medecin->slug) }}">Oui</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                          @else
                            <a class="" data-toggle="modal" data-target="#delete{{ $medecin->id }}">
                              <ion-icon name="close-outline" style="color: red"></ion-icon>
                            </li>
                            <div class="modal fade" id="delete{{ $medecin->id }}" tabindex="-1" role="dialog" aria-labelledby="delete{{ $medecin->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Voulez vous désactiver ce compte ?</h5>
                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                      </button>
                                    </div>
                                    <div class="modal-footer">
                                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Non </button>
                                      <a class="btn btn-primary" href="{{ URL::to('/desactiver-medecin/'.$medecin->slug) }}">Oui</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            
                          @endif
                          
                          <a href="{{ URL::to('/medecin-hopital/'.$medecin->slug) }}">
                            <ion-icon name="eye-outline"></ion-icon>
                          </a>
                          
                         
                          
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