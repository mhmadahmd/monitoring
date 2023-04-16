@extends('test::layouts.master')

@section('content')
    <h1>Hello World
     
    </h1>

    <p>
        This view is loaded from module: {!! config('test.name') !!}
    </p>
    <div id="navMenu" class="diamond">
        <div id="mainRotCorrect" class="rotCorrect"><i class="fa fa-cubes fa-4x" aria-hidden="true"></i></div>
      </div>
      <div id="nav1" class="nav nav1 diamond">
        <div class="rotCorrect"><i class="fa fa-home fa-2x" aria-hidden="true"></i></div>
      </div>
      <!--<div class="popUp">Home</div>-->
      <div id="nav2" class="nav nav2 diamond">
        <div class="rotCorrect"><i class="fa fa-file-text-o fa-2x" aria-hidden="true"></i></div>
      </div>
      <div id="nav3" class="nav nav3 diamond">
        <div class="rotCorrect"><i class="fa fa-calendar fa-2x" aria-hidden="true"></i></div>
      </div>
      <div id="nav4" class="nav nav4 diamond">
        <div class="rotCorrect"><i class="fa fa-line-chart fa-2x" aria-hidden="true"></i></div>
      </div>
      <div id="nav5" class="nav nav5 diamond">
        <div class="rotCorrect"><i class="fa fa-cogs fa-2x" aria-hidden="true"></i></div>
      </div>
@endsection
