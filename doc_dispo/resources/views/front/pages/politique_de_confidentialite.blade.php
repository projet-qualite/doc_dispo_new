@extends('front.layouts.app')


@section('content')
    <div id="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="/">Accueil</a></li>
                <li>Politique de confidentialité</li>
            </ul>
        </div>
    </div>

    <!--/aside -->
    <br> <br>
    <div class="container">

        <!--/container-->
        <div class="container">
            @foreach(getEntitesInRange(47, 80) as $entite)
                <div>
                    <h3 class="row justify-content-center" style="text-align: start">
                        <strong>{{$entite->titre}}</strong>
                    </h3><br>
                    <div class="row justify-content-center" >
                        <div class="col-lg-8">
                            <p>
                                {{$entite->texte}}
                            </p>
                        </div>
                    </div>
                    <br> <br>
                </div>
            @endforeach

        </div>
@endsection
