@extends('back.layouts.app')
@section('title-1')
    Hôpitaux
@endsection

@section('content')

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des hôpitaux</div>
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
                    <th>Libelle</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($hopitaux as $hopital)
                    <tr>
                        <td>
                            {{ $hopital->libelle }}
                        </td>
                        <td>
                            {{ $hopital->email }}
                        </td>
                        <td>
                            {{ $hopital->telephone }}
                        </td>
                        <td style="display: flex; justify-content: center;">
                          
                          @if ($hopital->etat_compte == 0)

                          

                          <a class="" data-toggle="modal" data-target="#delete{{ $hopital->id }}">
                            <ion-icon name="checkbox-outline" style="color: green"></ion-icon>
                          </li>
                          <div class="modal fade" id="delete{{ $hopital->id }}" tabindex="-1" role="dialog" aria-labelledby="delete{{ $hopital->id }}" aria-hidden="true">
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
                                    @if ($hopital->slug != "")
                                        <a class="btn btn-primary" href="{{ URL::to('/activer-hopital/'.$hopital->slug) }}">Oui</a>
                                    @else
                                        <a class="btn btn-primary" href="{{ URL::to('/activer-hopital/'.$hopital->id) }}">Oui</a>
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                          @else
                            <a class="" data-toggle="modal" data-target="#delete{{ $hopital->id }}">
                              <ion-icon name="close-outline" style="color: red"></ion-icon>
                            </li>
                            <div class="modal fade" id="delete{{ $hopital->id }}" tabindex="-1" role="dialog" aria-labelledby="delete{{ $hopital->id }}" aria-hidden="true">
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
                                      @if ($hopital->slug != "")
                                            <a class="btn btn-primary" href="{{ URL::to('/desactiver-hopital/'.$hopital->slug) }}">Oui</a>
                                        @else
                                            <a class="btn btn-primary" href="{{ URL::to('/desactiver-hopital/'.$hopital->id) }}">Oui</a>
                                        @endif
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                            
                          @endif



                          @if ($hopital->slug != "")
                            <a href="{{ URL::to('/admin-hopital/'.$hopital->slug) }}">
                                <ion-icon name="eye-outline"></ion-icon>
                            </a>
                          @else
                            <a href="{{ URL::to('/admin-hopital/'.$hopital->id) }}">
                                <ion-icon name="eye-outline"></ion-icon>
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