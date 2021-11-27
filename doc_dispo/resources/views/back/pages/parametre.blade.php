@extends('back.layouts.app')
@section('title-1')
    Paramètre
@endsection
@section('title-2')
Parametres du compte
@endsection

@section('content')

    @if (Session::has('user'))
        @include('back.includes.parametres.parametre_user')
    @else

    @if (Session::has('medecin'))
        @include('back.includes.parametres.parametre_medecin') 
    @else
    @if (Session::has('hopital'))
        @include('back.includes.parametres.parametre_hopital')
    @else
        @include('back.includes.parametres.parametre_admin') 
    @endif
    @endif

    @endif

@stop