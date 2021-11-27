

    @if (Session::has('user'))
        @include('back.includes.sidebar.sidebar_user')
    @else

    @if (Session::has('medecin'))
        @include('back.includes.sidebar.sidebar_medecin') 
    @else
    @if (Session::has('hopital'))
        @include('back.includes.sidebar.sidebar_hopital')
    @else
        @include('back.includes.sidebar.sidebar_admin') 
    @endif
    @endif

    @endif

