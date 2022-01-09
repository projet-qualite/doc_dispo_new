@extends('front.layouts.app')

@section('content')


<main>
    <div id="hero_register">
        <div class="container margin_120_95">
            <div class="row">
                <div class="col-lg-6">
                    <h1>Mot de passe oublié</h1>
                    <p class="lead">
                        Veuillez entrer votre adresse mail pour pouvoir réinitialiser votre
                        mot de passe.
                    </p>


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
                                    <input type="email" required class="form-control" name="email" placeholder="Votre adresse mail">
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
