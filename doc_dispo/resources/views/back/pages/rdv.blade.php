@extends('back.layouts.app')
@section('title-1')
    Rdv
@endsection
@section('title-2')
   Mes rendez-vous
@endsection

@section('content')

@if (Session::has('user'))
    @include('back.includes.rdv.rdv_user')
@else
    @if (Session::has('medecin'))
        @include('back.includes.rdv.rdv_medecin') 
    @else
        @if (Session::has('hopital'))
            @include('back.includes.rdv.rdv_hopital')
        @else
            @include('back.includes.rdv.rdv_admin') 
        @endif
    @endif

@endif
@stop