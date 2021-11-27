@extends('back.layouts.app')
@section('title-1')
    Motif
@endsection

@section('content')

<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>{{$action}} un motif</h2>
    </div>
    <form action="" method="post" id="" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if (isset($motif))
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

                        @if (isset($motif))
                            <input type="text"  class="form-control" value="{{ $motif->libelle }}" name="libelle" placeholder="Libelle du motif">
                        @else
                            <input type="text"  class="form-control" value="{{ old('libelle') }}" name="libelle" placeholder="Libelle du motif">
                        @endif

                        @error('libelle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row clearfix">
               

                
                
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-round">{{$action}} un motif</button>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>Liste des motifs</h2>
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
                <th>Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($motifs as $motif)
                <tr>
                    <td>
                        {{ $motif->libelle }}
                    </td>
                    
                    <td style="display: flex; justify-content: center; align-content: center">
                        <a href="{{ URL::to('/motif/'.$motif->slug) }}" class="nav-link">
                            <i class="fa fa-edit fa-2x"></i>
                        </a>
                       
                        <a class="nav-link" data-toggle="modal" data-target="#delete{{ $motif->id }}">
                            <i class="fa fa-trash fa-2x" style="margin-right: 10px"></i>
                        </li>
                        <div class="modal fade" id="delete{{ $motif->id }}" tabindex="-1" role="dialog" aria-labelledby="delete{{ $motif->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Voulez vous supprimer ce motif ?</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler </button>
                                  <a class="btn btn-primary" href="{{ URL::to('/delete-motif/'.$motif->id) }}">Confirmer</a>
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