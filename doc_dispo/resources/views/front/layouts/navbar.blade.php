<div class="container">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div id="logo_home">
                <a href="{{URL::to('/')}}" title="Findoctor"> <img id="logo_home" src="{{asset('front/img/'.getEntite(45)->img)}}" /> </a>
            </div>
        </div>
        <nav class="col-lg-9 col-6">
            <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="#0"><span>Menu mobile</span></a>
            <ul id="top_access">
                @if (Session::has('user') || Session::has('medecin') || Session::has('hopital') || Session::has('admin'))
                    <li id="user">
                        <a href="{{URL::to('/dashboard')}}">

                           @if (Session::has('user'))
                           <figure>
                            <img src="{{ is_null(Session::get('user')->img_1) ? asset('front/img/avatar.png') : asset('front/img/users/'.Session::get('user')->img_1) }}" alt="">
                           </figure>
                            {{Session::get('user')->email}}
                           @endif

                           @if (Session::has('medecin'))
                           <figure>
                            <img src="{{ is_null(Session::get('medecin')->img_1) ? asset('front/img/avatar.png') : asset('front/img/medecins/'.Session::get('medecin')->img_1) }}" alt="">
                           </figure>
                            {{Session::get('medecin')->email}}
                           @endif

                           @if (Session::has('hopital'))
                           <figure>
                            <img src="{{ is_null(Session::get('hopital')->img) ? asset('front/img/avatar.png') : asset('front/img/hopitaux/'.Session::get('hopital')->img) }}" alt="">
                           </figure>
                            {{Session::get('hopital')->email}}
                           @endif


                           @if (Session::has('admin'))
                           <figure>
                            <img src="{{ asset('front/img/avatar.png') }}" alt="">
                           </figure>
                            {{Session::get('admin')->email}}
                           @endif
                        </a>
                    </li>
                @else
                    <li><a href="{{URL::to('/connexion')}}"><i class="pe-7s-user"></i></a></li>
                    <li><a href="{{URL::to('/inscription')}}"><i class="pe-7s-add-user"></i></a></li>
                @endif



            </ul>
            <div class="main-menu">
                <ul class="nav">
                    @foreach(getEntites(9) as $items)
                        <li class="item">
                            <a href="{{URL::to('/'.$items->lien)}}" class="show-submenu {{ (Request::segment(1) == $items->lien ? 'active' : '') }}">{{$items->texte}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- /main-menu -->
        </nav>
    </div>
</div>
