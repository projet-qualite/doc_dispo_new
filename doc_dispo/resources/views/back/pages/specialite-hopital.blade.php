@extends('back.layouts.app')
@section('title-1')
    Spécialité
@endsection

@section('content')

<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>Ajouter une spécialité</h2>
    </div>
    <form action="" method="post" id="">
        {{ csrf_field() }}
        <div class="body">
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
           
            
          
            <div class="row clearfix">
              
                <div class="col-sm-3">
                    <select name="specialite" required class="form-control show-tick">
                        <option value>Spécialités</option>
                        @foreach ($specialites as $specialite)
                            <option value="{{ $specialite->id }}">{{ $specialite->libelle }}</option>
                        @endforeach
                    </select>
                    @error('specialite')
                            <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                </div>
                
             
              
                
                
                <div class="col-sm-12" style="margin-top: 20px">
                    <button type="submit" class="btn btn-primary btn-round">Ajouter une spécialité</button>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>Liste des spécialités</h2>
    </div>

<div class="card-body">
    @if (Session::has('success_'))
    <div class="alert alert-success">
        {{ Session::get('success_') }}
        {{ Session::put('success_', null) }}
    </div>
    @endif

    @if (Session::has('fail_'))
    <div class="alert alert-danger">
        {{ Session::get('fail_') }}
        {{ Session::put('fail_', null) }}
    </div>
    @endif
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
            <th>Nom</th>
            <th>Supprimer</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($specialites_h as $specialite)
            <tr>
                <td>
                    {{ $specialite->libelle }}
                </td>
                <td>
                    <a class="nav-link" data-toggle="modal" data-target="#delete{{ $specialite->id_specialite_hopital }}">
                        <i class="fa fa-trash fa-2x" style="margin-right: 10px"></i>
                    </li>
                    <div class="modal fade" id="delete{{ $specialite->id_specialite_hopital }}" tabindex="-1" role="dialog" aria-labelledby="delete{{ $specialite->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Voulez vous supprimer cette spécialité ?</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler </button>
                              <a class="btn btn-primary" href="{{ URL::to('/delete/specialite/hopital/'.$specialite->id_specialite_hopital) }}">Confirmer</a>
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




@stop