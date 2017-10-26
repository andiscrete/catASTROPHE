@extends('layouts.master')

@section('content')
<h2>Login</h2>
{{ Form::open(array('url' => 'login')) }}
<div class="form-group">
  <label for="email">Email address</label>
  <input type="email" class="form-control" id="email" name="email" value="{{Input::old('email')}}" placeholder="Email">
</div>
<div class="form-group">
  <label for="password">Password</label>
  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
</div>
<button type="submit" class="btn btn-primary">Login</button>
{{ Form::close() }}
<p>Not a member? <a href='/user/create'>Join Here</a>!
@stop
