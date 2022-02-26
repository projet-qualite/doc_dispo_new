<div class="row">
    <div class="col-xl-4 col-sm-6 mb-3">
      <div class="card dashboard text-white bg-4 o-hidden h-100">
        <div class="card-body">
          <div class="card-body-text">
              {{ $hopitalA }}
          </div>
          <div class="mr-5"><h5>Hôpitaux</h5></div>
        </div>
        <a class="card-footer card-footer-white text-black-50 clearfix small z-1" href="{{ URL::to('/admin/hopitaux') }}">
          <span class="float-left">Voir en détail</span>
          <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-3">
      <div class="card dashboard text-white bg-3 o-hidden h-100">
        <div class="card-body">
          <div class="card-body-text">
              {{ $medecinsA }}
          </div>
            <div class="mr-5"><h5>Medecins</h5></div>
        </div>

      </div>
    </div>


    <div class="col-xl-4 col-sm-6 mb-3">
        <div class="card dashboard text-white bg-2 o-hidden h-100">
          <div class="card-body">
            <div class="card-body-text">
                {{ $rdvA }}
            </div>
              <div class="mr-5"><h5>Rendez-vous</h5></div>
          </div>

        </div>
      </div>


  </div>
