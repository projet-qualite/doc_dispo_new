<div class="box_general">
    <div class="header_box">
        <h2 class="d-inline-block">Liste des rendez-vous</h2>
        <div class="filter">
            <!--
            <select name="orderby" class="form-control" id="select-dates">
                <option value="all">Tous les rdv</option>
                <option value="next">Prochains Rdv</option>
                <option value="today">Ajourd'hui</option>
                <option value="previous">Rdv passés</option>
            </select>-->
        </div>
    </div>
    <div class="list_general">
        <ul>
            @foreach ($rdvs as $rdv)
                <li class="rdvs">
                    <figure><img src="{{ isset($rdv->img_1) ? asset('/front/img/medecins/'.$rdv->img_1) :  asset('/front/img/default.jpg') }}" alt=""></figure>
                    <h4>{{ $rdv->type }} {{strtoupper($rdv->nom)}} {{ucfirst($rdv->prenom)}} </h4>
                    <ul class="booking_details">
                        <li><strong>Patient: </strong>  {{ $rdv->nom_proche }} {{ $rdv->prenom_proche }}</li>
                        <li><strong>Date rdv: </strong><a id="date_creneau_rdv">{{ $rdv->jour }}</a> </li>
                        <li><strong>Heure rdv: </strong> {{ $rdv->heure }}</li>
                        <li><strong>Specialité: </strong> {{ $rdv->libelle_specialite }}</li>
                        <li><strong>Telephone</strong> {{ $rdv->telephone }}</li>
                        <li><strong>Email</strong> {{ $rdv->email }}</li>
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</div>