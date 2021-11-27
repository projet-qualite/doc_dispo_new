@extends('front.layouts.app')

@section('content')


<main>
    <div id="hero_register">
        <div class="container margin_120_95">			
            <div class="row">
                <div class="col-lg-6">
                    <h1>Inscrivez vous</h1>
                    <p class="lead">Te pri adhuc simul. No eros errem mea. Diam mandamus has ad. Invenire senserit ad has, has ei quis iudico, ad mei nonumes periculis.</p>
                    <div class="box_feat_2">
                        <i class="pe-7s-map-2"></i>
                        <h3>Let patients to Find you!</h3>
                        <p>Ut nam graece accumsan cotidieque. Has voluptua vivendum accusamus cu. Ut per assueverit temporibus dissentiet.</p>
                    </div>
                    <div class="box_feat_2">
                        <i class="pe-7s-date"></i>
                        <h3>Easly manage Bookings</h3>
                        <p>Has voluptua vivendum accusamus cu. Ut per assueverit temporibus dissentiet. Eum no atqui putant democritum, velit nusquam sententiae vis no.</p>
                    </div>
                    <div class="box_feat_2">
                        <i class="pe-7s-phone"></i>
                        <h3>Instantly via Mobile</h3>
                        <p>Eos eu epicuri eleifend suavitate, te primis placerat suavitate his. Nam ut dico intellegat reprehendunt, everti audiam diceret in pri, id has clita consequat suscipiantur.</p>
                    </div>
                </div>
                <!-- /col -->
                <div class="col-lg-5 ml-auto">
                    <form action="{{url('/mdp_oublie')}}" method="post" id="">
                        {{ csrf_field() }}
                        {!! method_field('GET') !!}
                            <div class="box_form">
                                @if (Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                        {{ Session::put('success', null) }}
                                    </div>
                                    
                                @endif

                                @if (Session::has('fail'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('fail') }}
                                        {{ Session::put('fail', null) }}
                                    </div> 
                                @endif
                                <div class="form-group">
                                    <select name="user_type" required id="select" class="custom-select form-control">
                                        <option disabled selected value="">Vous êtes: </option>
                                        <option value="hopital">Un Hopital</option>
                                        <option value="medecin">Un Medecin</option>
                                        <option value="utilisateur">Un Patient</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" required class="form-control" name="email" placeholder="Your email address">
                                </div>

                               
                                <div class="form-group text-center add_top_30">
                                    <input class="btn_1" type="submit" value="Réinitialiser mot de passe">
                                </div>
                            </div>
                        </form>
                    <!-- /box_form -->
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /hero_register -->
</main>
    
@endsection