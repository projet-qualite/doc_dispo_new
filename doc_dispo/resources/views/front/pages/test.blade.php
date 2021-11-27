<div id="infos_planning" class="block_profil">
    <div id="planning_header">
        <p class="rh2"><img id="horloge_rdv" src="{{ asset('/front/img/horloge_blue.png') }}" alt="Prendre Rendez-vous">Prendre Rendez-vous</p>
    </div>

    <div id="spe_pra_ctn">
        <div id="type_rdv_ctn" style="display: block;">
            <div class="profil_list_ctn">
                <div class="profil_list_label noselect" id="type_rdv">
                    <p id="type_rdv_val">Pour obtenir la liste des rdv disponibles, veuillez sélectionner la spécialité. </p>
                    <img src="{{ asset('/front/img/select.png') }}" alt="Rdv">
                </div>
                <div>
                    <select name="" id="specialites-hopital">
                        <option disabled selected value="">Choisir une spécialite</option>
                        @foreach ($specialites as $specialite)
                            <option value="{{ $specialite->libelle }}">{{ $specialite->libelle }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="specialites-medecin">
                    <div id="choix-medecin">
                        <p>Choisir un medecin</p>
                        <img id="choix-medecin-btn" src="{{asset('front/img/select.png')}}" style="color: black" alt="">
                    </div>

                    <div id="list-medecins-choix" class="list-medecin-invisible">
                        @foreach ($medecins as $medecin)
                        <div class="medecin-spe" style="display: none">
                            <p>
                                {{ strtoupper($medecin->nom) }} {{ ucfirst($medecin->prenom) }}
                            </p>
                            @foreach ($medecin->specialites as $specialite)
                                <p class="specialite-of-medecin" style="display: none">
                                    {{ $specialite->libelle }}
                                </p> 
                            @endforeach

                        </div>  
                    @endforeach
                    </div>
                </div>

                <div class="profil_list" id="type_rdv_list" style="display: none;">
                    <p class="choice_list_v" id="key_0" onclick="clickTypeRdv(this)" title="consultation de suivi ">Consultation De Suivi  </p>
                </div>
            </div>
        </div>
    </div>


   

    
    
</div>