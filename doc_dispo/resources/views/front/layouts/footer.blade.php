<div class="container margin_60_35">
    <div class="row">
        <div class="col-lg-3 col-md-12">
            <p>
                <a href="{{URL::to('/')}}" title="Findoctor">
                    <img src="{{asset('front/img/'.getEntite(45)->img)}}" data-retina="true" alt="" width="163" height="36" class="img-fluid">
                </a>
            </p>
            <div class="follow_us">
                <ul>
                    @foreach( getEntitesInRange(30, 33) as $social)
                        <li><a href="{{$social->lien}}"><i class="{{$social->img}}"></i></a></li>
                    @endforeach
                </ul>
            </div>
            <a href="{{getEntite(34)->img}}" class="fadeIn"><img src="{{asset('front/img/'.getEntite(34)->img)}}" alt="" width="150" height="50" data-retina="true"></a>
        </div>
        <div class="col-lg-3 col-md-4">
            <h5>{{getEntite(18)->titre}}</h5>
            <ul class="links">
                @foreach( getEntitesInRange(19, 21) as $link)
                    <li><a href="{{URL::to('/'.$link->lien)}}">{{$link->texte}}</a></li>
                @endforeach

            </ul>
        </div>
        <div class="col-lg-2 col-md-4">
            <h5>{{getEntite(22)->titre}}</h5>
            <ul class="links">
                <li><a href="{{URL::to('/'.getEntite(23)->lien)}}">{{getEntite(23)->texte}}</a></li>
                <li><a href="{{getEntite(24)->lien}}">{{getEntite(24)->texte}}</a></li>
            </ul>
        </div>
        <div class="col-lg-4 col-md-4">
            <h5>{{getEntite(25)->titre}}</h5>
            <ul class="contacts">

                    <li><a href="'tel://'.{{ getEntite(26)->lien  }}"><i class="{{getEntite(26)->img}}"></i> <strong>{{getEntite(26)->titre}}</strong> {{getEntite(26)->texte}}</a></li>
                    <li><a href="'mailto:'.{{ getEntite(29)->lien  }}"><i class="{{ getEntite(29)->img  }}"></i><strong>{{ getEntite(29)->titre  }}</strong> {{ getEntite(29)->texte  }}</a></li>
            </ul>

        </div>
    </div>
    <!--/row-->
    <hr>
    <div class="row">
        <div class="col-md-8">
            <ul id="additional_links">
                <li><a href="{{URL::to('/'.getEntite(35)->lien)}}">{{getEntite(35)->titre}}</a></li>
            </ul>
        </div>
        <div class="col-md-4">
            <div id="copy">© <script>document.write(new Date().getFullYear())</script> Doc & Moi</div>
        </div>
    </div>
</div>
