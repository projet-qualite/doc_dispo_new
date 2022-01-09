<div class="hero_home version_1">

    <div class="content">
      <h3>Trouver facilement et rapidement un professionel de santé!</h3>
      <p>
        Prise de rendez-vous en ligne pour votre consultation
      </p>
      <form method="" action="" style="margin-left: 20px">
        <div id="custom-search-input">
          <div class="input-group">
            <input type="text" class="search-query" required placeholder="Ex. Nom, Specialisation, Hôpital ....">
            <input type="submit" class="btn_search" value="">
          </div>
         <div class="result" style="position: absolute; top: 55px;background-color: white; height: 38vh; width: 100%; overflow-y: auto">
         @foreach ($medecins as $medecin)
            <a href="{{URL::to('/medecin/'.$medecin->slug)}}">
              <div class="resultElement">
                <img src="{{ is_null($medecin->img_1) ? asset('front/img/default.jpg') : asset('front/img/medecins/'.$medecin->img_1) }}" alt="">
                <div class="content">
                  <small>{{ (isset($medecin->type)) ? $medecin->type : '' }} {{ $medecin->nom }}</small>
                  <small></small>
                </div>
              </div>
            </a>
          @endforeach


          @foreach ($specialites as $specialite)
            <a href="{{URL::to('/medecins/specialite/'.$specialite->libelle)}}">
              <div class="resultElement">
                <div class="content">
                  <small></small>
                  <small>{{ $specialite->libelle }}</small>
                </div>
              </div>
            </a>
          @endforeach


          @foreach ($hopitaux as $hopital)
            <a href="{{URL::to('/hopital/'.$hopital->libelle)}}">
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
    <div class="content-2">
        <img src="{{asset('front/img/banner.png')}}">
    </div>

  </div>
