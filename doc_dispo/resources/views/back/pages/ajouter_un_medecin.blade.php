@extends('back.layouts.app')
@section('title-1')
    Medecin
@endsection
@section('title-2')
   Ajouter un medecin
@endsection

@section('content')

<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>Ajouter un medecin</h2>
    </div>
    <form action="{{url('/add-medecin')}}" method="post" id="">
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
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" required class="form-control" name="nom" placeholder="Nom">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" required class="form-control" name="prenom" placeholder="Prenom">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="email" required class="form-control" name="email" placeholder="Email">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" required class="form-control" name="telephone" placeholder="Telephone">
                    </div>
                </div>
                

                
                
              
                
                
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-round">Ajouter un medecin</button>
                </div>
            </div>
        </div>
    </form>
</div>

@stop