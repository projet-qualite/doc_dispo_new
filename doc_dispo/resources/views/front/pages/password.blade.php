@extends('front.layouts.app')

@section('content')


<main>
    <div id="hero_register">
        <div class="container margin_120_95">			
            <div class="row">
                <div class="col-lg-6">
                    <h1>Changez votre mot de passe</h1>
                    <p class="lead">Ce lien n'est valide qu'une seule fois</p>
                    
                </div>
                <!-- /col -->
                <div class="col-lg-5 ml-auto">
                    <form action="{{url('/update-medecin-pwd/'.$id)}}" method="post" id="">
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
                                    <input type="password" required value="{{ old('mot_de_passe') }}" class="form-control" name="email" placeholder="Votre adresse mail">
                                    @error('mot_de_passe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" minlength="8" required value="{{ old('c_mot_de_passe') }}" class="form-control" placeholder="Confirmer votre mot de passe" name="c_mot_de_passe" id="password">
                                    @error('c_mot_de_passe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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