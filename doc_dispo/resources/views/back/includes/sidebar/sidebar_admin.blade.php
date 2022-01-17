<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ URL::to('/') }}"><ion-icon name="arrow-back-outline"></ion-icon> Retour au site</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link {{ (Request::segment(1) == 'dashboard' ? 'active' : '') }}" href="{{ URL::to('/dashboard') }}">
              <ion-icon name="clipboard-outline"></ion-icon>
            <span class="nav-link-text">Tableau de bord</span>
          </a>
        </li>


        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link {{ (Request::segment(1) == 'assurance' ? 'active' : '') }}" href="{{ URL::to('/assurance') }}">
              <ion-icon name="shield-checkmark-outline"></ion-icon>
            <span class="nav-link-text">Assurances</span>
          </a>
        </li>




          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link {{ (Request::segment(1) == 'admin' ? 'active' : '') }}" href="{{ URL::to('/admin/hopitaux') }}">
                <ion-icon name="medkit-outline"></ion-icon>
              <span class="nav-link-text">Hôpitaux</span>
            </a>
          </li>


          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link {{ (Request::segment(1) == 'motif' ? 'active' : '') }}" href="{{ URL::to('/motif') }}">
                <ion-icon name="reader-outline"></ion-icon>
              <span class="nav-link-text">Motifs</span>
            </a>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link {{ (Request::segment(1) == 'specialite' ? 'active' : '') }}" href="{{ URL::to('/specialite') }}">
                <ion-icon name="list-circle-outline"></ion-icon>
              <span class="nav-link-text">Specialités</span>
            </a>
          </li>



      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{URL::to('/logout')}}" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Deconnexion</a>
        </li>
      </ul>
    </div>
  </nav>
