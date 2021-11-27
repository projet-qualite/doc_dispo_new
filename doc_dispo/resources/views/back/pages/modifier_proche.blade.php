@extends('back.layouts.app')
@section('title-1')
    Proche
@endsection
@section('title-2')
    Modifier un proche
@endsection

@section('content')

<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>Modifier un proche</h2>
    </div>
    <form action="{{url('/update-proche/'.$proche->slug)}}" method="post" id="">
        {{ csrf_field() }}
        {!! method_field('PUT') !!}
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
           
            
            <div class="row clearfix">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" value="{{ $proche->nom }}" required name="nom"class="form-control" placeholder="Nom">
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" value="{{ $proche->prenom }}" required name="prenom" class="form-control" placeholder="Prenom">
                        @error('prenom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="date" value="{{ $proche->date_naissance }}" required class="form-control" name="date_naissance" placeholder="Date de naissance">
                        @error('date_naissance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <select name="sexe" required class="form-control show-tick">
                        <option value="">- Genre -</option>
                        <option value="m" {{ ($proche->sexe == 'm') ? 'selected': '' }}>Masculin</option>
                        <option value="f" {{ ($proche->sexe == 'f') ? 'selected': '' }}>Feminin</option>
                    </select>
                    @error('sexe')
                            <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" value="{{ $proche->telephone }}" required class="form-control" name="telephone" placeholder="Téléphone">
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="text" value="{{ $proche->email }}" required class="form-control" name="email" placeholder="Adresse mail">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
              
                
                
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-round">Modifier cet proche</button>
                </div>
            </div>
        </div>
    </form>
</div>

@stop