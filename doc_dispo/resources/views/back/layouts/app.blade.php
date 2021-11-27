<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Ansonika">
  <title>FINDOCTOR - Admin dashboard</title>
	
  <!-- Favicons-->

	
  <!-- GOOGLE WEB FONT -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">
	
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('back/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Icon fonts-->
  <link href="{{ asset('back/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
  <!-- Plugin styles -->
  <link href="{{ asset('back/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
  <!-- Main styles -->
  <link href="{{ asset('back/css/admin.css')}}" rel="stylesheet">
  <!-- Your custom styles -->
  <link href="{{ asset('back/css/admin.css')}}" rel="stylesheet">
	
</head>

<body class="fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
 @include('back.includes.sidebar')
  <!-- /Navigation-->
   


    <div class="content-wrapper">
      <div class="container-fluid">
       <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">@yield('title-1')</a>
        </li>
        <li class="breadcrumb-item active">@yield('title-2')</li>
      </ol>
        @yield('content')
      </div>
    </div>
       @include('back.layouts.footer')
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Souhaitez vous vous déconnecter ?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Mettez fin à votre session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
            <a class="btn btn-primary" href="{{URL::to('/logout')}}">Se deconnecter</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('back/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('back/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('back/js/admin.js')}}"></script>
	<!-- Custom scripts for this page-->
    <script src="{{ asset('back/js/date-creneau.js')}}"></script>
    <script src="{{ asset('back/js/script.js')}}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	
	
</body>
</html>
