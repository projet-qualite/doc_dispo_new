@extends('back.layouts.app')
@section('title-1')
    Spécialité
@endsection
@section('title-2')
    Modifier une spécialité
@endsection

@section('content')

<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>Modifier une spécialité</h2>
    </div>
    <form action="{{url('/update-specialite/'.$specialite->slug)}}" method="post" id="">
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
                        <input type="text" value="{{ $specialite->libelle }}"  class="form-control" name="libelle" placeholder="Libéllé spécialité">
                        @error('libelle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                
                
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-round">Modifier cette spécialité</button>
                </div>
            </div>
        </div>
    </form>
</div>

@stop