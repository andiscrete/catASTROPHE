@extends('layouts.master')

@section('content')
<div class="jumbotron">
  <h2>Welcome!</h2>
  <p class="lead">Please feel free to browse these lovely pictures brought to you coutesy of Pexels.</p>
  <a class="btn btn-lg btn-primary" href="/user/create" role="button">Join </a>
</div>
<div class="row">
  <div class="col-sm-4">
    <div class="card pull-left" style="">
      <img class="card-img-top" src="https://images.pexels.com/photos/39317/chihuahua-dog-puppy-cute-39317.jpeg?h=350&auto=compress&cs=tinysrgb" alt="Card image cap">
      <div class="card-body">
        <h4 class="card-title">Dogs in Teacups</h4>
        <p class="card-text">It's important to occasionally <i>paws</i> for a cup of tea</p>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card pull-left" style="">
      <img class="card-img-top" src="https://images.pexels.com/photos/45242/wolf-torque-wolf-moon-cloud-45242.jpeg?h=350&auto=compress&cs=tinysrgb" alt="Card image cap">
      <div class="card-body">
        <h4 class="card-title">Emo Wolves</h4>
        <p class="card-text">Much Full Moon! Such intense! Wow!</p>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card pull-left" style="">
      <img class="card-img-top" src="https://images.pexels.com/photos/227691/pexels-photo-227691.jpeg?h=350&auto=compress&cs=tinysrgb" alt="Card image cap">
      <div class="card-body">
        <h4 class="card-title">Sheep</h4>
        <p class="card-text">I've <i>herd</i> that puns are good way to win people over</p>
      </div>
    </div>
  </div>
</div>
@stop
