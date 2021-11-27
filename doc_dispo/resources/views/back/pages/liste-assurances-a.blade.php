@extends('back.layouts.app')
@section('title-1')
    Assurances
@endsection
@section('title-2')
   Liste des assurances
@endsection

@section('content')

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des assurances</div>
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
                    <th>Logo</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($assurances as $assurance)
                    <tr>
                        <td>
                            {{ $assurance->nom }}
                        </td>
                        <td>
                            {{ isset($assurances->logo) ? asset('front/img/assurances/'.$assurances->logo) : '' }}
                        </td>
                        <td style="display: flex; justify-content: center; align-content: center">
                            <a href="{{ URL::to('/modifier-une-assurance-a/'.$assurance->slug) }}" class="nav-link">
                                <i class="fa fa-edit fa-2x"></i>
                            </a>
                           
                            <a class="nav-link" data-toggle="modal" data-target="#delete">
                                <i class="fa fa-trash fa-2x" style="margin-right: 10px"></i>
                            </li>
                            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Voulez vous supprimer ce proche ?</h5>
                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                      </button>
                                    </div>
                                    <div class="modal-footer">
                                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                                      <a class="btn btn-primary" href="{{ URL::to('/delete-assurance/'.$assurance->id) }}">Confirmer</a>
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