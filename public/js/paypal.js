
paypal.Button.render({
    env: 'sandbox',
    client: {
        sandbox:    'AdvwOXjoNNnkwDJxkY-JK-WRBudvdk_EfoNFk-PrRowvxzHc0b7YwjEg2EjdxZM2tMpBnZC9YckOAyRl',
        production: 'xxxxxxxxx'
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
          $.ajax({
            type: "PUT",
            url: "/user/validate",
            data: {
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
