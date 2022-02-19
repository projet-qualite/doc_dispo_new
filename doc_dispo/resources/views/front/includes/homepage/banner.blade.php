<div class="hero_home version_1">

    <div class="content">
      <h3>{{getEntite(7)->titre}}</h3>
      <p>
          {{getEntite(7)->texte}}
      </p>
        @include('front.includes.results')
    </div>
    <div class="content-2">
        <img src="{{asset('front/img/'.getEntite(46)->img)}}">
    </div>

  </div>
