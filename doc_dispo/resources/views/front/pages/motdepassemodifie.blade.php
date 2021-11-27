@extends('front.layouts.app')

@section('content')


<main>
    <div id="hero_register">
        <div class="container margin_120_95">			
            <div class="row">
                <div class="col-lg-6">
              
                <!-- /col -->
                <div class="col-lg-5 ml-auto">
                        {{ csrf_field() }}
                        {!! method_field('GET') !!}
                        
                            <div class="box_form">
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
                                
                            </div>
                    <!-- /box_form -->
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /hero_register -->
</main>
    
@endsection