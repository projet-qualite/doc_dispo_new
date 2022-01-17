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

          @if(Session::get('medecin')->etat_compte == 1)
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
                  <a class="nav-link {{ (Request::segment(1) == 'creneau' ? 'active' : '') }}" href="{{ URL::to('creneau') }}">
                      <ion-icon name="alarm-outline"></ion-icon>
                      <span class="nav-link-text">Créneau</span>
                  </a>
              </li>

              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add listing">
                  <a class="nav-link {{ (Request::segment(1) == 'motifs' ? 'active' : '') }}" href="{{ URL::to('motifs/medecin') }}">
                      <ion-icon name="reader-outline"></ion-icon>
                      <span class="nav-link-text">Motifs de consultation</span>
                  </a>
              </li>

          @endif


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
