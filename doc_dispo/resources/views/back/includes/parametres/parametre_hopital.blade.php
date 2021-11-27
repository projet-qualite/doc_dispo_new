<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>Parametres du compte</h2>
    </div>
    <form action="{{url('/parametre/hopital')}}" method="post" id="" enctype="multipart/form-data">
        {{ csrf_field() }}
        {!! method_field('PUT') !!}
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
        <div class="row clearfix">
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="text" value="{{ Session::get('hopital')->libelle }}" class="form-control" name="libelle" placeholder="Nom de l'hopital">
                    @error('libelle')
                            <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="text" value="{{ Session::get('hopital')->adresse }}" class="form-control" name="adresse" placeholder="Adresse">
                    @error('prenom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
            </div>                                    
           
          
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                  
                    <input type="text" name="telephone" value="{{ Session::get('hopital')->telephone }}" class="form-control" placeholder="Téléphone">
                    @error('date_naissance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            
            <div class="col-md-12">
                <button class="btn btn-primary btn-round">Sauvegarder les changements</button>
            </div>
        </div>
    </form>
</div>

<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>Modification du mot de passe</h2>
    </div>
    <form action="{{url('/parametre/mdp/hopital')}}" method="post" id="" enctype="multipart/form-data">
        {{ csrf_field() }}
        {!! method_field('PUT') !!}
        @if (Session::has('success_'))
            <div class="alert alert-success">
                {{ Session::get('success_') }}
                {{ Session::put('success_', null) }}
            </div>
            @endif

            @if (Session::has('fail_'))
            <div class="alert alert-danger">
                {{ Session::get('fail_') }}
                {{ Session::put('fail_', null) }}
            </div>
            @endif
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <input type="password" value="{{ old('ancien_mdp') }}" class="form-control" name="ancien_mdp" placeholder="Ancien mot de passe">
                    @error('ancien_mdp')
                            <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <input type="password" value="{{ old('nouveau_mdp') }}" class="form-control" name="nouveau_mdp" placeholder="Nouveau mot de passe">
                    @error('nouveau_mdp')
                            <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <input type="password" value="{{ old('c_nouveau_mdp') }}" class="form-control" name="c_nouveau_mdp" placeholder="Confirmer le nouveau mot de passe">
                    @error('c_nouveau_mdp')
                            <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
                                             
           
          
            
            <div class="col-md-12">
                <button class="btn btn-primary btn-round">Sauvegarder les changements</button>
            </div>
        </div>
    </form>
</div>

