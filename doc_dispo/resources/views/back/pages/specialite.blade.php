@extends('back.layouts.app')
@section('title-1')
    Spécialité
@endsection

@section('content')

<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>{{$action}} une spécialité</h2>
    </div>
    <form action="" method="post" id="">
        {{ csrf_field() }}
        @if (isset($specialite))
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
                        @if (isset($specialite))
                            <input type="text" required value="{{$specialite->libelle}}"  name="libelle"class="form-control" placeholder="Libéllé spécialité"> 
                        @else
                            <input type="text" required  name="libelle"class="form-control" placeholder="Libéllé spécialité"> 
                        @endif
                        @error('libelle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
            </div>
            <div class="row clearfix">
                
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-round">{{$action}} une spécialité</button>
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
                <th>Libéllé</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($specialites as $specialite)
                <tr>
                    <td>
                        {{ $specialite->libelle }}
                    </td>
                    <td style="display: flex; justify-content: center; align-content: center">
                        <a href="{{ URL::to('/specialite/'.$specialite->slug) }}" class="nav-link">
                            <i class="fa fa-edit fa-2x"></i>
                        </a>
                        <a class="nav-link" data-toggle="modal" data-target="#delete{{ $specialite->id }}">
                            <i class="fa fa-trash fa-2x" style="margin-right: 10px"></i>
                        </li>
                        <div class="modal fade" id="delete{{ $specialite->id }}" tabindex="-1" role="dialog" aria-labelledby="delete{{ $specialite->id }}" aria-hidden="true">
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
                                  <a class="btn btn-primary" href="{{ URL::to('/delete-specialite/'.$specialite->id) }}">Confirmer</a>
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