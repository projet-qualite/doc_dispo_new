@extends('front.layouts.app')

@section('content')


<main>
    <div id="hero_register">
        <div class="container margin_120_95">			
            <div class="row">
                <div class="col-lg-6">
                    <h1>Connectez vous</h1>
                    <p class="lead">Connectez vous sur l'application pour prendre rendez-vous.</p>
                    <div class="box_feat_2">
                        <i class="pe-7s-map-2"></i>
                        <h3>Trouvez facilement un praticien</h3>
                        <p>Vous trouverez sur l'application des praticiens.</p>
                    </div>
                    <div class="box_feat_2">
                        <i class="pe-7s-date"></i>
                        <h3>Gestion des rendez-vous</h3>
                        <p>Vous pourrez vous même choirsir vos créneau selon votre disponibilité</p>
                    </div>
                </div>
                <!-- /col -->
                <div class="col-lg-5 ml-auto">
                    <form action="{{url('/connecter')}}" method="post" id="">
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
                                    <select required name="user_type" id="select" class="custom-select form-control">
                                        <option value>Vous êtes: </option>
                                        <option {{ (old('user_type') == "hopital") ? "selected" : ""}} value="hopital">Un Hopital</option>
                                        <option {{ (old('user_type') == "medecin") ? "selected" : ""}} value="medecin">Un Medecin</option>
                                        <option {{ (old('user_type') == "utilisateur") ? "selected" : ""}} value="utilisateur">Un Patient</option>
                                    </select>
                                    @error('user_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" required value="{{ old('email') }}" class="form-control" name="email" placeholder="Votre adresse mail">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" minlength="8" required value="{{ old('mot_de_passe') }}" class="form-control" placeholder="Votre mot de passe" name="mot_de_passe" id="password">
                                    @error('mot_de_passe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <a href="{{URL::to('/forgot')}}" class="forgot"><small>Mot de passe oublié ?</small></a>
                                </div>
                                <div class="form-group">
                                    <input class="btn_1" type="submit" value="Connexion">
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