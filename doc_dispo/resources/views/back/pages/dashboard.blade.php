@extends('back.layouts.app')
@section('title-1')
    Tableau de bord
@endsection
@section('title-2')
   Mon tableau de bord
@endsection

@section('content')

    @if (Session::has('user'))
        @include('back.includes.dashboard.user_dashboard')
    @else

    @if (Session::has('medecin'))
        @include('back.includes.dashboard.medecin_dashboard') 
    @else
    @if (Session::has('hopital'))
        @include('back.includes.dashboard.hopital_dashboard')
    @else
        @include('back.includes.dashboard.admin_dashboard') 
    @endif
    @endif

    @endif

@stop