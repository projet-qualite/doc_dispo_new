@extends('back.layouts.app')
@section('title-1')
    Proche
@endsection


@section('content')

<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>{{$action}} un proche</h2>
    </div>
    <form action="" method="post" id="">
        {{ csrf_field() }}
        @if (isset($proche))
            {!! method_field('PUT') !!}
        @endif
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
                <div class="col-sm-6">
                    <div class="form-group">
                        @if (isset($proche))
                            <input type="text"  required class="form-control" value="{{ $proche->nom }}" name="nom" placeholder="Nom">
                        @else
                            <input type="text" required  class="form-control" value="{{ old('nom') }}" name="nom" placeholder="Nom">
                        @endif

                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        @if (isset($proche))
                            <input type="text"  required class="form-control" value="{{ $proche->prenom }}" name="prenom" placeholder="Prenom">
                        @else
                            <input type="text" required  class="form-control" value="{{ old('prenom') }}" name="prenom" placeholder="Prenom">
                        @endif

                        @error('prenom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-sm-3">
                    <div class="form-group">
                        @if (isset($proche))
                            <input type="date"  class="form-control" value="{{ $proche->date_naissance }}" name="date_naissance" placeholder="Date de naissance">
                        @else
                            <input type="date"  class="form-control" value="{{ old('date_naissance') }}" name="date_naissance" placeholder="Date de naissance">
                        @endif

                        @error('date_naissance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                    </div>
                </div>
                <div class="col-sm-3">
                    <select name="sexe" required class="form-control show-tick">


                        @if (isset($proche))
                            <option value="">- Genre -</option>
                            <option value="m" {{ ($proche->sexe == "m") ? 'selected' : '' }}>Masculin</option>
                            <option value="f" {{ ($proche->sexe == "f") ? 'selected' : '' }}>Feminin</option>
                        @else
                            <option value="">- Genre -</option>
                            <option value="m">Masculin</option>
                            <option value="f">Feminin</option>
                        @endif

                        @error('sexe')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        
                    </select>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        @if (isset($proche))
                            <input type="text" required class="form-control" value="{{ $proche->telephone }}" name="telephone" placeholder="Téléphone">
                        @else
                            <input type="text" required class="form-control" name="telephone" placeholder="Téléphone">
                        @endif
                        
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        
                <div class="col-sm-6">
                    <div class="form-group">

                        @if (isset($proche))
                            <input type="text"  class="form-control" value="{{ $proche->ville }}" name="ville" placeholder="Ville">
                        @else
                            <input type="text"  class="form-control" name="ville" placeholder="Ville">
                        @endif
                        @error('ville')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">

                        @if (isset($proche))
                            <input type="text"  class="form-control" value="{{ $proche->commune }}" name="commune" placeholder="Commune">
                        @else
                            <input type="text"  class="form-control" name="commune" placeholder="Commune">
                        @endif
                        @error('commune')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
              
                
                
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-round">{{$action}} un proche</button>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>Liste des proche</h2>
    </div>
    <div class="card-body">
        @if (Session::has('success_delete'))
        <div class="alert alert-success">
            {{ Session::get('success_delete') }}
            {{ Session::put('success_delete', null) }}
        </div>
        @endif

        @if (Session::has('fail_delete'))
        <div class="alert alert-danger">
            {{ Session::get('fail_delete') }}
            {{ Session::put('fail_delete', null) }}
        </div>
        @endif
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Ville</th>
                <th>Commune</th>
                <th>Date de naissance</th>
                <th>Genre</th>
                <th>Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($proches as $proche)
                <tr>
                    <td>
                        {{ $proche->nom }}
                    </td>
                    <td>
                        {{ $proche->prenom }}
                    </td>
                    <td>
                        {{ $proche->telephone }}
                    </td>
                    <td>
                        {{ $proche->ville }}
                    </td>
                    <td>
                        {{ $proche->commune }}
                    </td>
                    <td>
                        {{ $proche->date_naissance }}
                    </td>
                    <td>
                        {{ ($proche->sexe == "m") ? "Masculin" : "Feminin"  }}
                    </td>
                    

                    <td style="display: flex; justify-content: center; align-content: center">
                        <a href="{{ URL::to('/proche/'.$proche->slug) }}" class="nav-link">
                            <i class="fa fa-edit fa-2x"></i>
                        </a>
                       
                        <a class="nav-link" data-toggle="modal" data-target="#delete{{ $proche->id }}">
                            <i class="fa fa-trash fa-2x" style="margin-right: 10px"></i>
                        </li>
                        <div class="modal fade" id="delete{{ $proche->id }}" tabindex="-1" role="dialog" aria-labelledby="delete{{ $proche->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Voulez vous supprimer ce proche ?</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler </button>
                                  <a class="btn btn-primary" href="{{ URL::to('/delete-proche/'.$proche->id) }}">Confirmer</a>
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

