@extends('back.layouts.app')
@section('title-1')
    Page d'accueil
@endsection

@section('content')

    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Importer un logo</h2>
        </div>
        <form action="" method="post" id="" enctype="multipart/form-data">
            {{ csrf_field() }}
            {!! method_field('PUT') !!}
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
                    <input type="text"  class="form-control" value="1" name="id_partie" hidden>

                <div class="row clearfix">


                    <div class="col-sm-6">
                        <input type="text"  class="form-control" value="logo"  name="type" hidden>
                        <input type="file"  class="form-control"  name="img" placeholder="Logo">
                    </div>
                </div><br>
                <div class="row clearfix">

                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary btn-round">Importer</button>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Importer une image pour la page d'accueil</h2>
        </div>
        <form action="" method="post" id="" enctype="multipart/form-data">
            {{ csrf_field() }}
            {!! method_field('PUT') !!}
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
                <input type="text"  class="form-control" value="1" name="id_partie" hidden>

                <div class="row clearfix">


                    <div class="col-sm-6">
                        <input type="text"  class="form-control" value="banner"  name="type" hidden>
                        <input type="file"  class="form-control"  name="img" placeholder="Logo">
                    </div>
                </div><br>
                <div class="row clearfix">

                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary btn-round">Importer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>



@stop
