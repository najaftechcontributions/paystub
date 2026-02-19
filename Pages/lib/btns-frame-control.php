<style>
  #paypal-wrapper {
    width: 82%;
    max-width: 680px;
    margin: 0 auto;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    font-family: "PT Sans", sans-serif;
  }

  .paypal-cst-cont {
    width: 100%;
    max-width: 400px;
    margin: 16px auto 0;
  }

  @media (max-width: 768px) {
    #paypal-wrapper {
      width: 96%;
      max-width: 100%;
    }
  }

  @media (max-width: 480px) {
    #paypal-wrapper {
      width: 100%;
    }

    .paypal-cst-cont {
      max-width: 100%;
    }
  }
</style>

<script>
  function pypl_btns_render(ev) {
    var btns = jQuery('[happs-wrapper="paypal"]');

    if (ev == "loaded_stay_hidden") {
      btns.css("visibility", "");
      btns.css("display", "none");
    }

    if (ev == "loaded_stay_visile") {
      btns.css("visibility", "");
      btns.css("display", "flex");
    }

    if (ev == "show_btns") {
      btns.css("visibility", "");
      btns.css("display", "flex");
    }

    if (ev == "hide_btns") {
      btns.css("display", "none");
    }
  }
</script>
