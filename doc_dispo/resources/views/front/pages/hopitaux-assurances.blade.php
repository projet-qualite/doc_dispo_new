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
                                      <small>{{ (isset($medecin->type_medecin)) ? $medecin->type_medecin : '' }} {{ $medecin->nom }}</small>
                                      <small></small>
                                    </div>
                                  </div>
                                </a>
                              @endforeach
                      
                      
                              @foreach ($allSpecialites as $specialite)
                                <a href="{{URL::to('/medecins/specialite/'.$specialite->libelle)}}">
                                  <div class="resultElement">
                                    <div class="content">
                                      <small></small>
                                      <small>{{ $specialite->libelle }}</small>
                                    </div>
                                  </div>
                                </a>
                              @endforeach
                      
                      
                              @foreach ($allHopitaux as $hopital)
                                <a href="{{URL::to('/medecins/hopital/'.$hopital->libelle)}}">
                                  <div class="resultElement">
                                    <div class="content">
                                      <small></small>
                                      <small>{{ $hopital->libelle }}</small>
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
                @foreach ($hopitaux as $hopital)
                    <div class="strip_list fadeIn medecins-list enable">
                        
                        
                        <figure>
                            <a href="detail-page.html"><img src="{{ isset($hopital->img_1) ? asset('front/img/medecins/'.$hopital->img_1) : asset('front/img/default.jpg') }}" alt=""></a>
                        </figure>
                        <h3>{{ $hopital->libelle }}</h3>
                        <span><small class="specialite">{{ $hopital->email }}</small></span>
                        <span><small class="specialite">{{ $hopital->telephone }}</small></span>
                        

                       

                       
                        <ul>
                            <li><a href="{{ URL::to('/hopital/'.$hopital->slug) }}">Détail</a></li>
                        </ul>
                    </div>
                    
                @endforeach

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