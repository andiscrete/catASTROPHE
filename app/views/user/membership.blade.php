@extends('layouts.master')

@section('content')
<div class="jumbotron">
  <h2>Become a member!</h2>
  <p class='lead'>Join our membership all for the low low price of <b>£10</b> and receive a free, exclusive image of your favourite species!</p>
</div>
<center><div id="paypal-button"></div></center>
<script src="/js/paypal.js"></script>
@stop
