<style>
  /*#paypal-wrapper {
  width: 100%;
  max-width: 500px;
  margin-left: 32%;
  transform-origin: top center;
}*/

#paypal-wrapper {
    width: 80%;
    /* max-width: 500px; */
    /* margin-right: 0%; */
    transform-origin: top center;
    margin: auto;
    position: relative;
    flex-direction: column;
    
}

/* @media (max-width: 1040px) {
  #paypal-wrapper {
   margin-left: 12%;
  }
}

@media (max-width: 640px) {
  #paypal-wrapper {
   margin-left: 18%;
  }
} */

</style>

<script>
  function pypl_btns_render(ev){
    // console.log("fc:",ev);
    // return 0;

    var btns = jQuery('[happs-wrapper="paypal"]');

    if(ev == "loaded_stay_hidden"){
      btns.css("visibility","");
      btns.css("display","none");
    }

    if(ev == "loaded_stay_visile"){
      btns.css("visibility","");
      btns.css("display","flex");
    }


    if(ev == "show_btns"){
      btns.css("visibility","");
      btns.css("display","flex");
    }


    if(ev == "hide_btns"){
      btns.css("display","none");
    }

  }
</script>