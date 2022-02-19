@extends('back.layouts.app')
@section('title-1')
    Page d'accueil
@endsection

@section('content')

    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>{{$action}}</h2>
        </div>
        <form action="" method="post" id="" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if (isset($entite))
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

                    <input type="text"  class="form-control" value="8" name="id_partie" hidden>
                    @if (isset($entite))
                <div class="row clearfix">


                                <div class="col-sm-6">
                                    <input type="text"  class="form-control" value="{{ $entite->titre }}"  name="titre" placeholder="Titre">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text"  class="form-control" value="{{ $entite->texte }}" name="texte" placeholder="Texte">
                                </div>


                                <div class="col-sm-6" style="margin-top: 10px">
                                    <input type="text"  class="form-control" value="{{ $entite->lien }}" name="lien" placeholder="Lien">
                                </div>
                                <div class="col-sm-6" style="margin-top: 10px">
                                    <input type="text"  class="form-control" value="{{ $entite->img }}" name="img" placeholder="Image">
                                </div>





                </div><br>
                <div class="row clearfix">




                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary btn-round">{{$action}}</button>
                    </div>
                </div>
                    @endif
            </div>
        </form>
    </div>


    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Liste des textes</h2>
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
                        <th>Titre</th>
                        <th>Texte</th>
                        <th>Image</th>
                        <th>Lien</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($entites as $entite)
                        <tr>
                            <td>
                                {{ $entite->titre }}
                            </td>
                            <td>
                                {{ $entite->texte }}
                            </td>
                            <td>
                                {{ $entite->img }}
                            </td>
                            <td>
                                {{ $entite->lien }}
                            </td>


                            <td style="display: flex; justify-content: center; align-content: center">
                                <a href="{{ URL::to('/page/entite/mod/'.$entite->id_partie.'/'.$entite->id) }}" class="nav-link">
                                    <i class="fa fa-edit fa-2x"></i>
                                </a>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
