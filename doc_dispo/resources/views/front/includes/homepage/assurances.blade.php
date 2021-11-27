<div id="specialite_section">
    <div class="container">
        <h3 class="specialite-title">Nos assurances</h3> <br><br>
        <div class="row justify-space-arround specialite">
            @foreach ($assurances as $assurance)
            <div class="col-md-3 ">
                <a class="specialite-" href="{{URL::to('')}}">
                    <p>{{ $assurance->nom }}</p>
                  </a>
            </div>
           
            @endforeach
           
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>