@extends('front.layouts.app')


@section('content')

<main>
    <div id="results">
        <div class="container">
            <div class="row">
                    <div class="filters_listing">
                        <form method="" action="">
                            <div id="custom-search-input">
                              <div class="input-group">
                                <input type="text" class="search-query" required placeholder="Ex. Nom, Specialisation, Hôpital ....">
                                <input type="submit" class="btn_search" value="Rechercher">
                              </div>
                             <div class="result" style="position: absolute; top: 55px;background-color: white; height: 18vh; width: 100%; overflow-y: auto">
                              @foreach ($medecins as $medecin)
                                <a href="{{URL::to('/medecin/'.$medecin->id)}}">
                                  <div class="resultElement">
                                    <img src="http://via.placeholder.com/565x565.jpg" alt="">
                                    <div class="content">
                                      <small>{{ (isset($medecin->type)) ? $medecin->type : '' }} {{ $medecin->nom }}</small>
                                      <small></small>
                                    </div>
                                  </div>
                                </a>


                                <a href="{{URL::to('/medecins/specialite/'.$medecin->libelle_specialite)}}">
                                  <div class="resultElement">
                                    <div class="content">
                                      <small></small>
                                      <small>{{ $medecin->libelle_specialite }}</small>
                                    </div>
                                  </div>
                                </a>
                      
                      
                                <a href="{{URL::to('/medecins/hopital/'.$medecin->libelle_hopital)}}">
                                  <div class="resultElement">
                                    <div class="content">
                                      <small></small>
                                      <small>{{ $medecin->libelle_hopital }}</small>
                                    </div>
                                  </div>
                                </a>
                              @endforeach
                      
                                
                                
                              
                             </div>
                              
                            </div>
                          </form>
                        
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
                @foreach ($medecins as $medecin)
                    <div class="strip_list fadeIn medecins-list enable">
                        @if (isset($medecin->creneaux[0]))
                            <p class="next-rdv">
                                1er rendez-vous disponible <br>
                                <span class="jour">{{ $medecin->creneaux[0]->date_creneau }}</span> - 
                                <span class="heure">{{ $medecin->creneaux[0]->heure_creneau }}</span>
                            </p>
                        @else
                        <p class="next-rdv">
                            Pas de créneaux disponibles
                        </p>
                        @endif
                        
                        <figure>
                            <a href="detail-page.html"><img src="{{ isset($medecin->img_1) ? asset('front/img/medecins/'.$medecin->img_1) : asset('front/img/default.jpg') }}" alt=""></a>
                        </figure>
                        <h3>{{ $medecin->type_medecin }} {{ $medecin->nom }} {{ ucfirst($medecin->prenom) }}</h3>
                        @if (isset($medecin->specialites))
                            @foreach ($medecin->specialites as $specialite)
                                <span><small class="specialite">{{ $specialite->libelle }}</small></span>
                            @endforeach
                        @endif

                        @if (isset($medecin->specialites))
                            @foreach ($medecin->hopitaux as $hopital)
                                <small class="hopital" hidden>{{ $hopital->libelle }}</small>
                            @endforeach
                        @endif
                        

                       
                        <p>{{ $medecin->biographie }}</p>
                        <ul>
                            <li><a href="{{ URL::to('/medecin/'.$medecin->slug) }}">Prendre Rendez-vous</a></li>
                        </ul>
                    </div>
                    
                @endforeach

                
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
                <!-- /pagination -->
            </div>
            <!-- /col -->
            
            
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</main>


@endsection