@extends('front.layouts.app')


@section('content')

<main>
    <div id="results">
        <div class="container">
            <div class="row">
                    <div class="filters_listing">
                        @include('front.includes.results')

                </div>

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /results -->


    <!-- /filters -->



    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-12" >
                @foreach ($hopitaux as $hopital)
                    <div class="strip_list fadeIn medecins-list enable">


                        <figure>
                            <a><img src="{{ isset($hopital->img) ? asset('front/img/hopitaux/'.$hopital->img) : asset('front/img/default.jpg') }}" alt=""></a>
                        </figure>
                        <h3>{{ $hopital->libelle }}</h3>
                        <span><small class="specialite">{{ $hopital->email }}</small></span>
                        <span><small class="specialite">{{ $hopital->telephone }}</small></span>





                        <ul>
                            <li><a href="{{ URL::to('/hopital/'.$hopital->slug) }}">Détail</a></li>
                        </ul>
                    </div>

                @endforeach

                <!--
                <nav aria-label="" class="add_top_20">
                    <ul class="pagination pagination-sm">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
                 /pagination -->
            </div>
            <!-- /col -->


        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</main>



@endsection
