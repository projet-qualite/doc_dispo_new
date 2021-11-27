@extends('back.layouts.app')
@section('title-1')
    Hopitaux
@endsection
@section('title-2')
   Liste des hôpitaux
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
                    <th></th>
                    <th>Prenom</th>
                    <th>Date de naissance</th>
                    <th>Telephone</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($medecins as $hôpital)
                    <tr>
                        <td>
                            {{ $hôpital->nom }}
                        </td>
                        <td>
                            {{ $hôpital->prenom }}
                        </td>
                        <td>
                            {{ $hôpital->date_naissance }}
                        </td>
                        <td>
                            {{ $hôpital->telephone }}
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