@extends('layouts.master')

@section('content')
<div class="jumbotron">
  <h2>Become a member!</h2>
  <p class='lead'>Join our membership all for the low low price of <b>£10</b> and receive a free, exclusive image of your favourite species!</p>
</div>
<center><div id="paypal-button"></div></center>
<script>
paypal.Button.render({
    env: '{{Config::get('app.paypal.environment')}}',
    client: {
        sandbox:    '{{Config::get('app.paypal.sandbox_id')}}',
        production: '{{Config::get('app.paypal.production_id')}}'
    },
    commit: true,
    payment: function(data, actions) {
      return actions.payment.create({
        payment: {
          transactions: [
            {
              amount: { total: '10.00', currency: 'GBP' }
            }
          ]
        }
      });
    },

    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function(payment) {
          console.log(payment);
          $.ajax({
            type: "PUT",
            url: "/user/{{Auth::id()}}/validate",
            data: {
              _token:'{{csrf_token()}}',
              payment:payment
            }
          })
          .done(function( msg ) {
            $("#paypal-button").hide();
            $("main").append($("<div>").addClass('alert').addClass('alert-success').html(msg));
          });
        });
    }
}, '#paypal-button');
</script>
@stop
