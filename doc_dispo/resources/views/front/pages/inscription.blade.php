@extends('front.layouts.app')

@section('content')


<main>
    <div id="hero_register">
        <div class="container margin_120_95">			
            <div class="row">
                <div class="col-lg-6">
                    <h1>Inscrivez vous</h1>
                    <p class="lead">Inscription facile et rapide sur l'application</p>
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
                        <form action="" method="post" id="">
                        {{ csrf_field() }}
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
                                    <label>Email</label>
                                    <input type="email" value="{{ old('email') }}" required class="form-control" name="email" placeholder="Votre adresse mail">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Téléphone</label>
                                    <input type="text" value="{{ old('telephone') }}" required class="form-control" name="telephone" placeholder="Téléphone">
                                    @error('telephone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Mot de passe</label>
                                    <input type="password" value="{{ old('mot_de_passe') }}" required class="form-control"  id="password1" name="mot_de_passe" placeholder="Mot de passe">
                                    @error('mot_de_passe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Confirmer le mot de passe</label>
                                    <input type="password" value="{{ old('c_mot_de_passe') }}" required class="form-control"  id="password1" name="c_mot_de_passe" placeholder="Confirmer le mot de passe">
                                    @error('c_mot_de_passe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                               
                                <div id="pass-info" class="clearfix"></div>
                                <div class="checkbox-holder text-left">
                                    <div class="checkbox_2">
                                        <input type="checkbox" required value="accept_2" id="check_2" name="check_2" checked>
                                        <label for="check_2"><span>J'accepte <strong>les Termes et &amp; Conditions</strong></span></label>
                                    </div>
                                </div>
                                <div class="form-group text-center add_top_30">
                                    <input class="btn_1" type="submit" value="Inscription">
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