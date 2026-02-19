function initiate_pypl_btns(){

var calc_iframe = document.getElementById('paystub-frame');
var edit_btn = calc_iframe.contentWindow.jQuery('[action="edit-stub"]');

// jQuery( document ).ready(function() {
// --------------------------------------

paypal.Buttons({

  onInit: function (data, actions) {
    // console.log('PayPal buttons loaded');

var edit_btn_visible = edit_btn.is(':visible');
// console.log(edit_btn_visible,edit_btn.length);

    if(edit_btn_visible){
      pypl_btns_render('loaded_stay_visible');
    }else{
    pypl_btns_render('loaded_stay_hidden');
    }

    

  },

  createOrder: function (data, actions) {
    return actions.order.create({
      purchase_units: [{
        description: "#desc#",
        amount: {
          currency_code: "USD",
          value: "#price#",
          breakdown: {
            item_total: {
              currency_code: "USD",
              value: "#price#"
            }
          }
        },
        items: [{
          name: "#title#",
          description: "#desc#",
          quantity: "1",
          unit_amount: {
            currency_code: "USD",
            value: "#price#"
          },
          category: "DIGITAL_GOODS"
        }]
      }]
    });
  },

  onApprove: function (data, actions) {
    return actions.order.capture().then(function (details) {
      // alert("Payment successful! Transaction ID: " + details.id);
      calc_iframe.contentWindow.download_paystub(details);
      jQuery('#paypal-button-container').hide();
      // console.log(details);
    });
  },

  onError: function (err) {
    console.log('PayPal error:', err);
    // alert("Error occurred, check console.");
  }

}).render('#paypal-button-container');

// --------------------------------------

// });

}


document.addEventListener('DOMContentLoaded', function () {
  const iframe = document.getElementById('paystub-frame');

  iframe.addEventListener('load', initiate_pypl_btns);
});