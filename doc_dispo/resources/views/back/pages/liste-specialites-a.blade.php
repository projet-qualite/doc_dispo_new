@extends('back.layouts.app')
@section('title-1')
    Spécialités
@endsection
@section('title-2')
   Liste des spécialités
@endsection

@section('content')

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des spécialités</div>
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
                            <a href="{{ URL::to('/modifier-une-specialite-a/'.$specialite->slug) }}" class="nav-link">
                                <i class="fa fa-edit fa-2x"></i>
                            </a>
                            <a href="{{ URL::to('/delete-specialite/'.$specialite->slug) }}" class="nav-link">
                              <i class="fa fa-trash fa-2x"></i>
                          </a>
                           
                           
                        </td>
                       
                      
                       
                    </tr>
                      
                  @endforeach
                  
              </tbody>
            </table>
          </div>
        </div>
      </div>
	
@stop