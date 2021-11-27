<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Prenez facilement un rdv chez un medecin">
	<meta name="author" content="Ansonika">
	<title>FINDOCTOR - Prenez facilement un rdv chez un medecin</title>

	<!-- Favicons-->
	
    
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
	<!-- BASE CSS -->
	<link href="{{asset('front/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('front/css/style.css')}}" rel="stylesheet">
	<link href="{{asset('front/css/menu.css')}}" rel="stylesheet">
	<link href="{{asset('front/css/vendors.css')}}" rel="stylesheet">
	<link href="{{asset('front/css/icon_fonts/css/all_icons_min.css')}}" rel="stylesheet">
    
	<!-- YOUR CUSTOM CSS -->
	<link href="{{asset('front/css/custom.css')}}" rel="stylesheet">
	<link href="{{asset('front/css/style-custom.css')}}" rel="stylesheet">

	

</head>

<body>

	<header class="header_sticky">
		@include('front.layouts.navbar')
	</header>


    <main>
        @yield('content')
    </main>


    <footer>
		@include('front.layouts.footer')
    </footer>

	<!-- COMMON SCRIPTS -->
		<script src="{{asset('front/js/jquery-3.5.1.min.js')}}"></script>

	<script src="{{asset('front/js/common_scripts.min.js')}}"></script>
	<script src="{{asset('front/js/functions.js')}}"></script>
	<script src="{{asset('front/js/style-custom.js')}}"></script>
	<script src="{{asset('front/js/hopital.js')}}"></script>


	
	<!-- SPECIFIC SCRIPTS -->
	
    

</body>

</html>