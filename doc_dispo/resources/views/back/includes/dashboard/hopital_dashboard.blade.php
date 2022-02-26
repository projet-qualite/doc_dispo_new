<div class="row">
    <div class="col-xl-6 col-sm-6 mb-3">
      <div class="card dashboard text-white bg-1 o-hidden h-100">
        <div class="card-body">
          <div class="card-body-text">
              {{ $medecinsH }}
          </div>
          <div class="mr-5"><h5>Medecins</h5></div>
        </div>
        <a class="card-footer card-footer-white text-black-50 clearfix small z-1" href="{{ URL::to('/medecins/hopital') }}">
          <span class="float-left">Voir en détail</span>
          <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-6 col-sm-6 mb-3">
      <div class="card dashboard text-white bg-2 o-hidden h-100">
        <div class="card-body">
          <div class="card-body-text">
              {{ $rdvH }}
          </div>
            <div class="mr-5"><h5>Rendez-vous</h5></div>
        </div>
        <a class="card-footer card-footer-white text-black-50 clearfix small z-1" href="{{ URL::to('/rdv/prochains') }}">
          <span class="float-left">Voir en détail</span>
          <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>


  </div>
