@extends('layouts.master')

@section('content')
<div class="jumbotron">
  <h2>Join Us!</h2>
  <p class="lead">Join this fabulous website by filling in the form below to receive all sorts of benefits, like the potential to become a member!</p>
</div>
{{ Form::open(array('url' => 'user/store')) }}
{{ Form::token(); }}

<div class="form-group">
  <label for="forename">Forename *</label>
  <input type="text" name="forename" class="form-control" id="forename" value="{{Input::old('forename')}}" placeholder="Forename">
</div>
<div class="form-group">
  <label for="surname">Surname *</label>
  <input type="text" name="surname" class="form-control" id="surname" value="{{Input::old('surname')}}"  placeholder="Surname">
</div>
<div class="form-group">
  <label for="email">Email address *</label>
  <input type="email" name="email" class="form-control" id="email" value="{{Input::old('email')}}"  placeholder="Email">
</div>
<div class="form-group">
  <label for="password">Password *</label>
  <input type="password" name="password" class="form-control" id="password" placeholder="Password">
</div>
<button type="submit" class="btn btn-primary">Join</button>
{{ Form::close() }}
@stop
