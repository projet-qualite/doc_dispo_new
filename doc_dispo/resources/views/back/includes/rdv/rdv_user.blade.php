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
                        <li><strong>Hopital: </strong> {{ $rdv->libelle_hopital }}</li>
                        <li><strong>Specialité: </strong> {{ $rdv->libelle_specialite }}</li>
                        <li><strong>Telephone</strong> {{ $rdv->telephone }}</li>
                        <li><strong>Email</strong> {{ $rdv->email }}</li>
                    </ul>
                    <ul class="buttons">
                        
                        <li>
                            <a class="nav-link btn_1 gray delete" data-toggle="modal" data-target="#delete{{ $rdv->slug_rdv }}">
                                <i class="fa fa-fw fa-times-circle-o"></i> Annuler</a>
                            </li>
                            <div class="modal fade" id="delete{{ $rdv->slug_rdv }}" tabindex="-1" role="dialog" aria-labelledby="delete{{ $rdv->slug_rdv }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Voulez vous annuler le rendez-vous ?</h5>
                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                      </button>
                                    </div>
                                    <div class="modal-footer">
                                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler </button>
                                      <a class="btn btn-primary" href="{{ URL::to('/annuler/rdv/'.$rdv->slug_rdv) }}">Confirmer</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</div>