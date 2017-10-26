@extends('layouts.master')

@section('content')
<div class="jumbotron">
  @if(!Auth::check())<h2>Welcome!</h2>@else<h2>Welcome {{Auth::user()->forename}} {{Auth::user()->surname}}!</h2>@endif
  <p class="lead">Please feel free to browse these lovely pictures brought to you royalty free coutesy of Pexels.</p>
  @if(!Auth::check())
  <a class="btn btn-lg btn-primary" href="/user/create" role="button">Join </a>
  @else
  @if(Auth::user()->member == 1)
  <a class="btn btn-lg btn-primary" href="/user/{{Auth::id()}}/member" role="button">Members Area</a>
  @else
  <a class="btn btn-lg btn-primary" href="/user/{{Auth::id()}}/membership" role="button">Become a Member</a>
  @endif
  @endif
</div>
<div class="row">
@forelse($animals as $animal)
<div class="col-sm-4">
  <div class="card">
    <img class="card-img-top" src="/images/{{$animal->image}}" alt="{{$animal->title}}">
    <div class="card-body">
      <h4 class="card-title">{{$animal->title}}</h4>
      <p class="card-text">{{$animal->cat_fact}}</p>
    </div>
  </div>
</div>
@empty
<p>Well this is a bit boring isn't it? Maybe try seeding the database for a 100% more catisfaction guaranteed!</p>
@endforelse
</div>
@stop
