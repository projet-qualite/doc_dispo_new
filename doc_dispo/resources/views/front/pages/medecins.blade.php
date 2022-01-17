@extends('front.layouts.app')


@section('content')


<main>
  <div id="results">
      <div class="container">
          <div class="row">
                  <div class="filters_listing">
                      @include('front.includes.results')

              </div>

          </div>
          <!-- /row -->
      </div>
      <!-- /container -->
  </div>
  <!-- /results -->


  <!-- /filters -->



  <div class="container margin_60_35">
      <div class="row">
          <div class="col-lg-12" >
              @for ($i = 0; $i < count($medecins); $i++)
                  <div class="strip_list fadeIn medecins-list enable">
                      @if (count($creneaux[$i]) != 0)
                          <p class="next-rdv">
                              1er rendez-vous disponible <br>
                              <span class="jour">{{ $creneaux[$i][0]->jour }}</span> -
                              <span class="heure">{{ $creneaux[$i][0]->heure }}</span>
                          </p>
                      @else
                      <p class="next-rdv">
                          Pas de créneaux disponibles
                      </p>
                      @endif

                      <figure>
                          <a><img src="{{ isset($medecins[$i]->img_1) ? asset('front/img/medecins/'.$medecins[$i]->img_1) : asset('front/img/default.jpg') }}" alt=""></a>
                      </figure>
                      <h3>{{ $medecins[$i]->type }} {{ $medecins[$i]->nom }} {{ ucfirst($medecins[$i]->prenom) }}</h3>

                      <span><small class="specialite">{{ $medecins[$i]->libelle_specialite }}</small></span>



                      <small class="hopital" hidden>{{ $medecins[$i]->libelle_hopital }}</small>




                      <p>{{ $medecins[$i]->biographie }}</p>
                      <ul>
                          <li><a href="{{ URL::to('/medecin/'.$medecins[$i]->slug) }}">Prendre Rendez-vous</a></li>
                      </ul>
                  </div>

              @endfor

              <!--
              <nav aria-label="" class="add_top_20">
                  <ul class="pagination pagination-sm">
                      <li class="page-item disabled">
                          <a class="page-link" href="#" tabindex="-1">Previous</a>
                      </li>
                      <li class="page-item active"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                          <a class="page-link" href="#">Next</a>
                      </li>
                  </ul>
              </nav>
               /pagination -->
          </div>
          <!-- /col -->


      </div>
      <!-- /row -->
  </div>
  <!-- /container -->
</main>


@endsection
