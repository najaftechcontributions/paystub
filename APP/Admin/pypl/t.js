function initiate_pypl_btns() {
  var calc_iframe = document.getElementById("paystub-frame");
  var edit_btn = calc_iframe.contentWindow.jQuery('[action="edit-stub"]');

  paypal
    .Buttons({
      onInit: function (data, actions) {
        if (edit_btn.is(":visible")) {
          pypl_btns_render("loaded_stay_visible");
        } else {
          pypl_btns_render("loaded_stay_hidden");
        }
      },

      // ✅ Optional: block click if totals not ready (not in preview yet)
      onClick: function (data, actions) {
        const st = window.__checkoutState;

        if (!st || !st.preview) {
          console.warn("PayPal blocked: Go to Preview first.");
          return actions.reject();
        }

        return actions.resolve();
      },

      createOrder: function (data, actions) {
        const st = window.__checkoutState;
        if (!st || !st.preview) return actions.reject();

        return fetch(window.PAYSTUB_AJAX, {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
          },
          body: new URLSearchParams({
            action: "paystub_create_order",
            paystubs: String(st.paystubs || 1),
            depositSlip: st.depositSlip ? "1" : "0",
          }),
        })
          .then((r) => r.json())
          .then((res) => {
            if (!res || !res.success || !res.data || !res.data.orderID) {
              console.warn("Server create order failed:", res);
              throw new Error("Could not create order");
            }
            return res.data.orderID;
          });
      },

      onApprove: function (data, actions) {
        const orderId = data.orderID;

        return actions.order.capture().then(function (details) {
          const captureId =
            details?.purchase_units?.[0]?.payments?.captures?.[0]?.id;

          if (!captureId) throw new Error("Missing captureId");

          return fetch(window.PAYSTUB_AJAX, {
            method: "POST",
            headers: {
              "Content-Type":
                "application/x-www-form-urlencoded; charset=UTF-8",
            },
            body: new URLSearchParams({
              action: "paystub_verify_capture",
              orderId: orderId,
              captureId: captureId,
            }),
          })
            .then((r) => r.json())
            .then((res) => {
              if (!res || !res.success) {
                console.warn("Server verification failed:", res);
                throw new Error("Payment verification failed");
              }

              // Only after server OK:
              calc_iframe.contentWindow.download_paystub(details);
              jQuery("#paypal-button-container").hide();
            });
        });
      },

      onError: function (err) {
        console.log("PayPal error:", err);
      },
    })
    .render("#paypal-button-container");
}

document.addEventListener("DOMContentLoaded", function () {
  const iframe = document.getElementById("paystub-frame");
  iframe.addEventListener("load", initiate_pypl_btns);
});
