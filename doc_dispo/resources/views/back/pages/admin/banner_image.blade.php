@extends('back.layouts.app')
@section('title-1')
    Page d'accueil
@endsection

@section('content')

    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>{{$action}}</h2>
        </div>
        <form action="" method="post" id="" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if (isset($entite))
                {!! method_field('PUT') !!}
            @endif
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
                        <input type="file"  class="form-control"  name="img" placeholder="ImageBanner">
                    </div>
                </div><br>
                <div class="row clearfix">

                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary btn-round">{{$action}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


@stop
