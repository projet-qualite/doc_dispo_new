<div class="row">
    <div class="col-xl-4 col-sm-6 mb-3">
      <div class="card dashboard text-white bg-primary o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fa fa-fw fa-envelope-open"></i>
          </div>
          <div class="mr-5"><h5>Hôpitaux ( {{ $hopitalA }} )</h5></div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="{{ URL::to('/admin/hopitaux') }}">
          <span class="float-left">Voir en détail</span>
          <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-3">
      <div class="card dashboard text-white bg-warning o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fa fa-fw fa-star"></i>
          </div>
            <div class="mr-5"><h5>Medecins ( {{ $medecinsA }} )</h5></div>
        </div>
        <a class="card-footer text-white clearfix small z-1">
          <span class="float-left"></span>

        </a>
      </div>
    </div>


    <div class="col-xl-4 col-sm-6 mb-3">
        <div class="card dashboard text-white bg-warning o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa fa-fw fa-star"></i>
            </div>
              <div class="mr-5"><h5>Rendez-vous ( {{ $rdvA }} )</h5></div>
          </div>
          <a class="card-footer text-white clearfix small z-1" >
            <span class="float-left"></span>

          </a>
        </div>
      </div>


  </div>
