@extends('layouts.master')

@section('content')
<div class="jumbotron">
  <h2>Welcome {{Auth::user()->forename}} {{Auth::user()->surname}}!</h2>
  <p class='lead'>Our esteemed benefactor!</p>

</div>
@stop
