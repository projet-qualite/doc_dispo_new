<div class="container margin_80_95">

    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-5 col-md-6">
            <div class="list_home">
                <div class="list_title">
                    <h3>{{getEntite(16)->titre}}</h3>
                </div>
                <ul>
                    @foreach ($assurances as $assurance)

                        <li>
                            <a class="specialite-" href="{{ URL::to('/hopitaux/assurance/'.$assurance->slug) }}">
                                <p>{{ $assurance->libelle }}</p>
                            </a>
                        </li>

                    @endforeach

                </ul>
            </div>
        </div>
        <div class="col-xl-6 col-lg-5 col-md-6">
            <div class="list_home">
                <div class="list_title">
                    <h3>{{getEntite(17)->titre}}</h3>
                </div>
                <ul>
                    @foreach ($specialites as $specialite)

                        <li>
                            <a class="specialite-" href="{{URL::to('/medecins/specialite/'.$specialite->libelle)}}">
                                <p>{{ $specialite->libelle }}</p>
                            </a>
                        </li>

                    @endforeach


                </ul>
            </div>
        </div>
    </div>
    <!-- /row -->
</div>
