@extends('back.layouts.app')
@section('title-1')
    Créneaux
@endsection

@section('content')



<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>Créneau</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">

                <form action="{{url('/creneau')}}" method="post" id="">
                    {{ csrf_field() }}
                    <div class="body">
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


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="date" id="date_"  class="form-control" name="date_creneau" placeholder="Date">
                                    @error('date_creneau')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="multi-select">Heures</label>
                                <div class="select select--multiple">
                                    <select name="heure_creneau[]" multiple="multiple"  class="form-control show-tick">
                                        <option value="all">Toutes les heures</option>
                                        <option value="all_am">Toutes la matinée</option>
                                        <option value="all_pm">Toute l'après-midi</option>
                                        <option value="8.00">8.00</option>
                                        <option value="8.30">8.30</option>
                                        <option value="9.00">9.00</option>
                                        <option value="9.30">9.30</option>
                                        <option value="10.00">10.00</option>
                                        <option value="10.30">10.30</option>
                                        <option value="11.00">11.00</option>
                                        <option value="11.30">11.30</option>
                                        <option value="12.00">12.00</option>
                                        <option value="12.30">12.00</option>
                                        <option value="13.00">13.00</option>
                                        <option value="13.30">13.30</option>
                                        <option value="14.00">14.00</option>
                                        <option value="14.30">14.30</option>
                                        <option value="15.00">15.00</option>
                                        <option value="15.30">15.30</option>
                                        <option value="16.00">16.00</option>
                                        <option value="16.30">16.30</option>
                                        <option value="16.30">17.00</option>
                                        <option value="16.30">17.30</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <select  name="motif"  class="form-control show-tick">

                                    <option value="">- Motifs de consulation -</option>
                                    <option value="all">Tous les motifs</option>
                                    @foreach ($motifs as $motif)
                                        <option value="{{ $motif->id_consultation }}">{{$motif->libelle}}</option>
                                    @endforeach

                                </select>
                                @error('motif')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--
                            <div class="col-sm-12">
                                <select name="hs" required class="form-control show-tick">
                                    <option value="">- Hopital - Spécialité -</option>


                                </select>

                            </div>
                        -->



                            <div class="col-sm-12" style="margin-top: 10px;">
                                <button type="submit" class="btn btn-primary btn-round">Ajouter un créneau</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>Liste des créneaux</h2>
    </div>
    <div class="card-body">
        @if (Session::has('success_delete'))
        <div class="alert alert-success">
            {{ Session::get('success_delete') }}
            {{ Session::put('success_delete', null) }}
        </div>
        @endif

        @if (Session::has('fail_delete'))
        <div class="alert alert-danger">
            {{ Session::get('fail_delete') }}
            {{ Session::put('fail_delete', null) }}
        </div>
        @endif
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
                <th>Date</th>
                <th>Heure</th>
                <th>Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($creneaux_m as $creneau)
                <tr>
                    <td>
                        {{ $creneau->jour }}
                    </td>

                    <td>
                        {{ $creneau->heure }}
                    </td>
                    <td style="display: flex; justify-content: center; align-content: center">
                        <a class="nav-link" data-toggle="modal" data-target="#delete{{ $creneau->id }}">
                            <i class="fa fa-trash fa-2x" style="margin-right: 10px"></i>
                        </li>
                        <div class="modal fade" id="delete{{ $creneau->id }}" tabindex="-1" role="dialog" aria-labelledby="delete{{ $creneau->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Voulez vous supprimer ce créneau ?</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler </button>
                                  <a class="btn btn-primary" href="{{ URL::to('/delete-creneau/'.$creneau->id) }}">Confirmer</a>
                                </div>
                              </div>
                            </div>
                          </div>
                    </td>



                </tr>

              @endforeach

          </tbody>
        </table>

      </div>
    </div>
</div>
@stop
