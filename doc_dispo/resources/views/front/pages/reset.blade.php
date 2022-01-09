@extends('front.layouts.app')

@section('content')


    <main>
        <div id="hero_register">
            <div class="container margin_120_95">
                <div class="row">
                    <div class="col-lg-6">
                        <h1>Réinitialisation du mot de passe</h1>
                        <p class="lead">
                            Veuillez entrer votre adresse mail pour pouvoir réinitialiser votre
                            mot de passe.
                        </p>


                    </div>
                    <!-- /col -->
                    <div class="col-lg-5 ml-auto">
                        <form action="{{url('/reset/'.$token.'/'.$email)}}" method="get" id="">
                            {{ csrf_field() }}
                            {!! method_field('PUT') !!}
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
                                        <input type="password" required minlength="8" required value="{{ old('mot_de_passe') }}" class="form-control" placeholder="Votre nouveau mot de passe" name="mot_de_passe" id="password">
                                        @error('mot_de_passe')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <input type="password" required minlength="8" required value="{{ old('c_mot_de_passe') }}" class="form-control" placeholder="Confirmer votre nouveau mot de passe" name="c_mot_de_passe" id="password">
                                        @error('c_mot_de_passe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
