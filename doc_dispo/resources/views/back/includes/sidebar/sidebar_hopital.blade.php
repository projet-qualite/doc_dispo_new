<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ URL::to('/') }}"><img src="{{ asset('front/img/logo_doc.png') }}" data-retina="true" alt="" width="163" height="36"></a>
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
          <a class="nav-link {{ (Request::segment(1) == 'affilier' ? 'active' : '') }}" href="{{ URL::to('/affilier') }}">
              <ion-icon name="shield-checkmark-outline"></ion-icon>
            <span class="nav-link-text">Assurances</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link {{ (Request::segment(1) == 'hopital-specialite' ? 'active' : '') }}" href="{{ URL::to('/hopital-specialite') }}">
              <ion-icon name="list-circle-outline"></ion-icon>
            <span class="nav-link-text">Spécialités</span>
          </a>
        </li>



        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
          <a class="nav-link nav-link-collapse collapsed {{ (Request::segment(1) == 'rdv' ? 'active' : '') }}" data-toggle="collapse" href="#collapseProfile" data-parent="#exampleAccordion">
              <ion-icon name="calendar-outline"></ion-icon>
            <span class="nav-link-text">Rdv</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseProfile">
            <li>
              <a href="{{ URL::to('/rdv/prochains') }}">Rendez-vous futurs</a>
            </li>
			      <li>
              <a href="{{URL::to('/rdv/passes')}}">Rendez-vous passés</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add listing">
            <a class="nav-link {{ (Request::segment(1) == 'medecins' ? 'active' : '') }}" href="{{ URL::to('/medecins/hopital') }}">
                <ion-icon name="medkit-outline"></ion-icon>
              <span class="nav-link-text">Liste des medecins</span>
            </a>
          </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add listing">
            <a class="nav-link {{ (Request::segment(1) == 'parametre' ? 'active' : '') }}" href="{{ URL::to('/parametre') }}">
                <ion-icon name="settings-outline"></ion-icon>
              <span class="nav-link-text">Paramètres du compte</span>
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
