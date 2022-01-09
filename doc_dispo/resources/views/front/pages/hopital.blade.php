@extends('front.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('/front/css/style-calendar.css') }}">
<link rel="stylesheet" href="{{ asset('/front/css/style-medecin.css') }}">
<main>

    <div class="info-profil">

        <div id="profil_medecin">
            <img id="profil-pic" src="{{ is_null($hopital->img) ? asset('front/img/default.jpg') : asset('front/img/hopitaux/'.$hopital->img) }}"  alt="">
            <div id="profil-info">
                <h1>{{ $hopital->libelle }}</h1>

                <div id="coord-medecin">
                    <p class="phone">
                        <img src="{{ asset('/front/img/letter.png') }}" alt="">
                        <a>{{ $hopital->email }}</a>
                    </p>
                    <p class="phone">
                        <img src="{{ asset('/front/img/phone.png') }}" alt="">
                        <a href="tel://{{ $hopital->telephone }}">{{ $hopital->telephone }}</a>
                    </p>
                </div>
            </div>
        </div>

        <!--<div id="description-container">
            <p>

            </p>
        </div>-->
    </div>
    <div id="list_collab_ctn" class="block_profil">

       <div class="row">
           @for ($i = 0; $i < count($medecins); $i++)
            <div class="col-md-4">
                <a href="{{ URL::to('/medecin/'.$medecins[$i]->slug) }}" class="doctor">
                    <img class="list_collab_img_pro" src="{{ isset($medecins[$i]->img_1) ? asset('front/img/medecins/'.$medecins[$i]->img_1) : asset('front/img/default.jpg') }}" alt="">
                    <div class="infos">
                        <p class="list_collab_i_name">{{ $medecins[$i]->type  }} {{ strtoupper($medecins[$i]->nom)  }} {{ ucfirst($medecins[$i]->prenom) }}</p>
                        <p class="list_collab_i_spe">

                            <span>{{ $medecins[$i]->libelle }} </span>

                        </p>
                        @if (count($creneaux[$i]) != 0)
                            <p>1er rdv:
                                <span class="">{{ $creneaux[$i][0]->jour }}</span> à
                                <span class="">{{ $creneaux[$i][0]->heure }}</span></p>
                        @else
                        <p >
                            Pas de créneaux disponibles
                        </p>
                        @endif

                    </div>
                </a>
            </div>
           @endfor
       </div>

    </div>



    <div class="assurances block_profil">
        <h3 class="title-assurance">Assurances</h3 >
        @foreach ($assurances as $assurance)
            <img width="100px" src="{{ asset('/front/img/assurances/'.$assurance->logo) }}" alt="">
        @endforeach

    </div>
</main>


<script>

</script>


@endsection

