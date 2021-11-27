@extends('back.layouts.app')
@section('title-1')
    Assurances
@endsection
@section('title-2')
   Liste des assurances affiliées
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