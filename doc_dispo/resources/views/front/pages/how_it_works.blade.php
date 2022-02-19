@extends('front.layouts.app')


@section('content')
<div id="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="/">Accueil</a></li>
            <li>Comment ça marche ?</li>
        </ul>
    </div>
</div>
<div class="container margin_60">
    <div class="row">

        <!--/aside -->

        <div class="col-lg-12" id="faq">
            <div role="tablist" class="add_bottom_45 accordion" id="payment">
                @foreach(getEntitesInRange(36, 38) as $entite)
                    <div class="card">
                        <div class="card-header" role="tab">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" href="#{{"collapse".$entite->id}}" aria-expanded="true">
                                    <i class="indicator icon_plus_alt2"></i>
                                    {{$entite->titre}}
                                </a>
                            </h5>
                        </div>

                        <div id="{{"collapse".$entite->id}}" class="collapse" role="tabpanel" data-parent="#payment">
                            <div class="card-body">
                                <p>
                                    {{$entite->texte}}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
            <!-- /accordion payment -->

            <div role="tablist" class="add_bottom_45 accordion" id="tips">
                @foreach(getEntitesInRange(39, 41) as $entite)
                    <div class="card">
                        <div class="card-header" role="tab">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" href="#{{"collapse".$entite->id}}" aria-expanded="true">
                                    <i class="indicator icon_plus_alt2"></i>
                                    {{$entite->titre}}
                                </a>
                            </h5>
                        </div>

                        <div id="{{"collapse".$entite->id}}" class="collapse" role="tabpanel" data-parent="#payment">
                            <div class="card-body">
                                <p>
                                    {{$entite->texte}}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- /accordion suggestions -->

            <div role="tablist" class="add_bottom_45 accordion" id="reccomendations">
                @foreach(getEntitesInRange(42, 44) as $entite)
                    <div class="card">
                        <div class="card-header" role="tab">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" href="#{{"collapse".$entite->id}}" aria-expanded="true">
                                    <i class="indicator icon_plus_alt2"></i>
                                    {{$entite->titre}}
                                </a>
                            </h5>
                        </div>

                        <div id="{{"collapse".$entite->id}}" class="collapse" role="tabpanel" data-parent="#payment">
                            <div class="card-body">
                                <p>
                                    {{$entite->texte}}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- /accordion Reccomendations -->



        </div>
        <!-- /col -->
    </div>
    <!-- /row -->
</div>

@endsection
