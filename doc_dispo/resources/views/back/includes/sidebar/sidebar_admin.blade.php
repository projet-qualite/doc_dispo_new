<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ URL::to('/') }}"><img src="{{ asset('front/img/logo_doc.png') }}" data-retina="true" alt="" width="163" height="36"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{ URL::to('/dashboard') }}">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Tableau de bord</span>
          </a>
        </li>


        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{ URL::to('/assurance') }}">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Assurances</span>
          </a>
        </li>


        

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link" href="{{ URL::to('/admin/hopitaux') }}">
              <i class="fa fa-fw fa-dashboard"></i>
              <span class="nav-link-text">Hôpitaux</span>
            </a>
          </li>


          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link" href="{{ URL::to('/motif') }}">
              <i class="fa fa-fw fa-dashboard"></i>
              <span class="nav-link-text">Motifs</span>
            </a>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link" href="{{ URL::to('/specialite') }}">
              <i class="fa fa-fw fa-dashboard"></i>
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