@extends('layouts.master')

@section('content')
<div class="jumbotron">
  <h2>Welcome {{Auth::user()->forename}} {{Auth::user()->surname}}!</h2>
  <p class='lead'>Our esteemed benefactor<?php if(isset(Auth::user()->favourite_species))echo (" and reputed lover of the <i>".Auth::user()->favourite_species."</i>"); ?>!</p>
</div>
@if($animal_id)
<p>It seems you have already been allocated a unique picture of your favourite species! Click below to download it:</p>
<center><a href='/animal/{{$animal_id}}'><button class="btn btn-success btn-lrg">Download</button></a></center>
@else
{{ Form::open(array('action' => array('UserController@species', Auth::id()), 'method'=>'GET')) }}
<div class="form-group">
  <label for="species">You are entitled to a free image of your favourite Species! Just pop the name of the critter in below and voil&agrave;!</label>
  <input type="text" class="form-control" id="species" name="species" placeholder="Species">
</div>
<button type="submit" class="btn btn-primary">GET IMAGE</button>
{{ Form::close() }}
@endif
@stop
