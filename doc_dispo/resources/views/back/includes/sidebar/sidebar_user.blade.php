<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    @include('back.includes.toogle-back')
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tableau de bord">
          <a class="nav-link {{ (Request::segment(1) == 'dashboard' ? 'active' : '') }}" href="{{ URL::to('/dashboard') }}">
              <ion-icon name="clipboard-outline"></ion-icon>
            <span class="nav-link-text">Tableau de bord</span>
          </a>
        </li>



        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Mes rendez-vous">
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


        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Mes proches">
          <a class="nav-link {{ (Request::segment(1) == 'proche' ? 'active' : '') }}" href="{{ URL::to('/proche') }}">
              <ion-icon name="people-outline"></ion-icon>
            <span class="nav-link-text">Mes proches</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Paramètres">
            <a class="nav-link {{ (Request::segment(1) == 'parametre' ? 'active' : '') }}" href="{{ URL::to('/parametre') }}">
                <ion-icon name="settings-outline"></ion-icon>
              <span class="nav-link-text">Paramètres du compte</span>
            </a>
          </li>

      </ul>
        @include('back.includes.toogle')
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link"   data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Deconnexion</a>
        </li>
      </ul>
    </div>
  </nav>
