/**
 * This initializes everything necessary to set up our donation form.
 *
 * Code here was heavily borrowed from the wonderful documentation at: 
 *    https://stripe.com/docs/recipes/variable-amount-checkout
 * 
 * Please see the Stripe documentation for more information.
 */

/**
 * Alias jQuery
 */
var $ = jQuery;

$(document).ready(function(){
  var handler = StripeCheckout.configure({
    key: drupalSettings.stripe_donation.stripe_publishable_key,
    locale: 'auto',
    name: drupalSettings.site.name,
    description: drupalSettings.stripe_donation.donation_name,
    token: function(token) {
      $('input#stripeToken').val(token.id);
      $('form#'+drupalSettings.stripe_donation.form_id).submit();
    }
  });

  $('#donate').on('click', function(e) {
    e.preventDefault();
  
    $('#error_explanation').html('');
  
    var amount = $('input#amount').val();
    amount = amount.replace(/\$/g, '').replace(/\,/g, '')
  
    amount = parseFloat(amount);
  
    if (isNaN(amount)) {
      $('#error_explanation').show();
      $('#error_explanation').html('<p>Please enter a valid amount in USD ($).</p>');
    }
    else if (amount <= 0) {
      $('#error_explanation').show();
      $('#error_explanation').html('<p>Donation amount must greater than 0.</p>');
    }
    else {
      amount = amount * 100; // Needs to be an integer!
      handler.open({
        amount: Math.round(amount)
      })
    }
  });
});
