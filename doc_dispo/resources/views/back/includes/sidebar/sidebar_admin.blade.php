<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    @include('back.includes.toogle-back')
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
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
              <a class="nav-link nav-link-collapse collapsed {{ (Request::segment(1) == 'page' ? 'active' : '') }}" data-toggle="collapse" href="#collapseProfile" data-parent="#exampleAccordion">
                  <ion-icon name="calendar-outline"></ion-icon>
                  <span class="nav-link-text">Pages</span>
              </a>
              <ul class="sidenav-second-level collapse" id="collapseProfile">
                  <li>
                      <a href="{{URL::to('/page/entite/3')}}">Comment ça marche</a>
                  </li>
                  <li>
                      <a href="{{URL::to('/page/entite/8')}}">Footer</a>
                  </li>
                  <li>
                      <a href="{{URL::to('/page/img/entite/10')}}">Logo - Banner image</a>
                  </li>
                  <li>
                      <a href="{{URL::to('/page/entite/9')}}">Navbar</a>
                  </li>
                  <li>
                      <a href="{{ URL::to('/page/entite/1') }}">Page d'accueil</a>
                  </li>
                  <li>
                      <a href="{{ URL::to('/page/entite/11') }}">Politique de confidentialité</a>
                  </li>


              </ul>
          </li>



      </ul>
        @include('back.includes.toogle')
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{URL::to('/logout')}}" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Deconnexion</a>
        </li>
      </ul>
    </div>
  </nav>
