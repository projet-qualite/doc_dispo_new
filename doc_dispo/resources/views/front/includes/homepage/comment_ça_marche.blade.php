<div class="container margin_120_95">
    <div class="main_title">
        <?php echo getEntite(10)->titre ?>
    </div>
    <div class="row add_bottom_30">
        @foreach(getEntitesInRange(11, 14) as $entite)
            <div class="col-lg-3">
                <a href="{{ URL::to('/'.$entite->lien) }}" class="how-it-works">
                    <div class="box_feat" id="{{$entite->img}}">
                        <span></span>
                        <h3>{{$entite->titre}}</h3>
                        <p>{{$entite->texte}}</p>
                    </div>
                </a>

            </div>

        @endforeach

    </div>
    <!-- /row -->
    <p class="text-center"><a href="{{URL::to('/medecins')}}" class="btn_1 find medium">{{getEntite(15)->titre}}</a></p>

</div>
