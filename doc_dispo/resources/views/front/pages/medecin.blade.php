@extends('front.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('/front/css/style-calendar.css') }}">
<link rel="stylesheet" href="{{ asset('/front/css/style-medecin.css') }}">
<main>

    <div class="info-profil">

        <div id="profil_medecin">
            <img id="profil-pic" src="{{ is_null($medecin->img_1) ? asset('front/img/default.jpg') : asset('front/img/medecins/'.$medecin->img_1) }}"  alt="">
            <div id="profil-info">
                <h1>{{ (isset($medecin->type_medecin)) ? $medecin->type_medecin : '' }} {{ strtoupper($medecin->nom) }} {{ $medecin->prenom }}</h1>
               <div id="specialites-medecin">

               </div>

                <div id="coord-medecin">

                    <p>
                        <img src="{{ asset('/front/img/phone.png') }}" alt="">
                        <a href="tel://{{ $medecin->telephone }}">{{ $medecin->telephone }}</a>
                    </p>

                    <p>
                        <img src="{{ asset('/front/img/letter.png') }}" alt="">
                        <a href="">{{ $medecin->email }}</a>
                    </p>
                </div>
            </div>
        </div>
        <div id="description-container">
            <p>
                {{ $medecin->biographie }}
            </p>
        </div>
    </div>

    <div id="infos_planning" class="block_profil">
        <div id="planning_header">
            <p class="rh2"><img id="horloge_rdv" src="{{ asset('/front/img/horloge_blue.png') }}" alt="Prendre Rendez-vous">Prendre Rendez-vous</p>
        </div>
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

        <div id="spe_pra_ctn">
            <div id="type_rdv_ctn" style="display: block;">
                <div class="profil_list_ctn">
                    <div class="profil_list_label noselect" id="type_rdv">
                        <p id="type_rdv_val">Pour obtenir la liste des rdv disponibles, veuillez sélectionner le motif. </p>
                        <img src="{{ asset('/front/img/select.png') }}" alt="Rdv">
                    </div>
                    <div>
                        <select name="" id="motifs-du-medecin" class="form-control">
                            <option value="">Selectionner un motif</option>
                            @foreach ($motifs as $motif)
                                <option value="{{ $motif->id_motif_consult }}">{{ $motif->libelle }}</option>
                            @endforeach
                        </select>
                    </div> <br>
                    <div class="profil_list" id="type_rdv_list" style="display: none;">
                        <p class="choice_list_v" id="key_0" onclick="clickTypeRdv(this)" title="consultation de suivi ">Consultation De Suivi  </p>
                    </div>
                </div>
            </div>
        </div>


        <div id="planning">
            <div id="rdv_dispo">
                <p id="alert_choice" style="display: none;"></p>
                <div id="gif_load_rdv_dispo" style="display: none;"><img src="/img/gif_load.gif" alt="chargement"></div>
                <ul id="rdv_dispo_list">


                </ul>
                @if (!Session::has('user'))
                    <p id="message">

                    </p>

                @endif
            </div>

            <div class="calendar">
                <div id="choice-month-year">
                  <div id="choice-month-div">
                    <div id="choice-month">
                      <p id="label-choice-month"></p>
                      <img id="btn-choice-month" src="{{ asset('/front/img/select.png') }}" alt="">
                    </div>
                    <div id="choice-month-list-div" class="isNotVisible">
                      <ul id="choixe-month-list">
                        <li class="choice-month-value">Janvier</li>
                        <li class="choice-month-value">Fevrier</li>
                        <li class="choice-month-value">Mars</li>
                        <li class="choice-month-value">Avril</li>
                        <li class="choice-month-value">Mai</li>
                        <li class="choice-month-value">Juin</li>
                        <li class="choice-month-value">Juillet</li>
                        <li class="choice-month-value">Août</li>
                        <li class="choice-month-value">Septembre</li>
                        <li class="choice-month-value">Octobre</li>
                        <li class="choice-month-value">Novembre</li>
                        <li class="choice-month-value">Décembre</li>
                      </ul>
                    </div>
                  </div>
                  <div id="choice-year-div">
                    <div id="choice-year">
                      <p id="label-choice-year">2021</p>
                      <img id="btn-choice-year" src="{{ asset('/front/img/select.png') }}" alt="">
                    </div>


                    <div id="choice-year-list-div" class="isNotVisible">
                      <ul id="choice-year-list">
                        <li class="choice-year-value">2021</li>
                        <li class="choice-year-value">2022</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div id="day-labels">
                  <p class="label-day">L</p>
                  <p class="label-day">M</p>
                  <p class="label-day">M</p>
                  <p class="label-day">J</p>
                  <p class="label-day">V</p>
                  <p class="label-day">S</p>
                  <p class="label-day">D</p>
                </div>
                <div id="app-calendar"></div>
              </div>
        </div>
        @error('id_creneau')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror



    </div>


   @if (Session::has('user'))
    <div id="carte_container" class="block_profil">
            <form action="{{url('/ajouter/rdv/'.$medecin->id)}}" method="post">
                {{ csrf_field() }}

                <input type="text" name="id_creneau" id="id_creneau" hidden>

                <!-- /row -->

                <div class="main_title_3 second" id="patient">
                    <h3>Selectionnez le patient</h3>
                </div>

                    <select name="proche" id="" class="form-control">
                        <option disabled selected value="">Selectionnez le patient</option>
                        @foreach ($proches as $proche)
                            <option value="{{ $proche->id }}">{{ $proche->nom }} {{ $proche->prenom }}
                                @if($proche->owner == 1)
                                    ( Moi )
                                @endif
                            </option>
                        @endforeach
                        @error('proche')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </select>



                <p class="text-center" style="margin-top: 20px"><button class="btn_1 second medium">Valider</button></p>

            </form>
        </div>

   @endif


</main>


<script>
    var creneaux = <?= json_encode($creneaux) ?>

</script>

<script src="{{ asset('/front/js/test.js') }}"></script>

@endsection

