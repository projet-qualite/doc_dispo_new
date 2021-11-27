<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>Parametres du compte</h2>
    </div>
    <form action="{{url('/parametre/medecin')}}" method="post" id="" enctype="multipart/form-data">
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
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <p>
                        Spécialité: {{ isset($specialite->libelle) ? $specialite->libelle : '' }}
                    </p>
                    <p>
                        Hopital: {{ isset($hopital->libelle) ? $hopital->libelle : '' }}
                    </p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="text" value="{{ Session::get('medecin')->nom }}" class="form-control" name="nom" placeholder="Nom">
                    @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="text" value="{{ Session::get('medecin')->prenom }}" class="form-control" name="prenom" placeholder="Prenom">
                    @error('prenom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
            </div>                                    
           
          
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                  
                    <input type="date" name="date_naissance" value="{{ Session::get('medecin')->date_naissance }}" class="form-control" placeholder="Date naissance">
                    @error('date_naissance')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <select name="sexe" class="form-control">
                    <option value="">- Genre -</option>
                    <option value="m" {{  (Session::get('medecin')->sexe == 'm') ? 'selected' : '' }}>Masculin</option>
                    <option value="f" {{  (Session::get('medecin')->sexe == 'f') ? 'selected' : '' }}>Feminin</option>
                </select>
                @error('sexe')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> <br>

            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                  
                    <input type="text" name="telephone" value="{{ Session::get('medecin')->telephone }}" class="form-control" placeholder="Téléphone">
                    @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <select name="type_medecin" class="form-control">
                    <option value="">- Qualification -</option>
                    <option value="Dr." {{  (Session::get('medecin')->type == 'Dr.') ? 'selected' : '' }}>Docteur</option>
                    <option value="Inf." {{  (Session::get('medecin')->type == 'Inf.') ? 'selected' : '' }}>Infirmier</option>
                    <option value="Pr." {{  (Session::get('medecin')->type == 'Pr.') ? 'selected' : '' }}>Professeur</option>
                </select>
                @error('type_medecin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <label>Photo de profil</label>
                    <input accept="image/*" type='file' name="photo" id="image">
                </div>
            </div>

            @if (Session::get('medecin')->etat_compte == 0)
                <div class="col-lg-6 col-md-12">
                    <select name="hopital" id="" class="form-control">
                        <option value="">Hôpital</option>
                        @foreach ($hopitaux as $hopital)
                            <option {{ (Session::get('medecin')->id_hopital == $hopital->id) ? 'selected' : '' }} value="{{ $hopital->id }}">{{ $hopital->libelle }}</option>           
                        @endforeach
                    </select>
                    @error('hopital')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endif
            
            <div class="col-md-12">
                <div class="form-group m-b-10">
                    <textarea rows="5" name="biographie"  class="form-control no-resize" placeholder="Biographie">{{ Session::get('medecin')->biographie }}</textarea>
                </div>
            </div>
            
            <div class="col-md-12">
                <button class="btn btn-primary btn-round">Sauvegarder les changements</button>
            </div>
        </div>
    </form>
</div>

@if (Session::get('medecin')->etat_compte == 0)
<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-lock"></i>Entrez votre spécialité</h2>
    </div>
    <form action="{{url('/parametre/medecin/specialite')}}" method="post" id="" enctype="multipart/form-data">
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
   
        <div class="col-lg-12 col-md-12">
                <select name="hopital_specialite" id="" class="form-control">
                    <option value="">Choisir la spécialité</option>
                    @foreach ($specialites as $specialite)
                        <option value="{{ $specialite->id }}">{{ $specialite->libelle }}</option>
                    @endforeach
                </select>
                @error('hopital_specialite')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
        </div>

        <div class="col-md-12">
            <button class="btn btn-primary btn-round">Sauvegarder les changements</button>
        </div>

    </form>

    
   
</div>

@endif


        

        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-lock"></i>Modification du mot de passe</h2>
            </div>
            <form action="{{url('/parametre/mdp/medecin')}}" method="post" id="" enctype="multipart/form-data">
                {{ csrf_field() }}
                {!! method_field('PUT') !!}
                @if (Session::has('success__'))
                    <div class="alert alert-success">
                        {{ Session::get('success__') }}
                        {{ Session::put('success__', null) }}
                    </div>
                    @endif
        
                    @if (Session::has('fail__'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail__') }}
                        {{ Session::put('fail__', null) }}
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
        
    
