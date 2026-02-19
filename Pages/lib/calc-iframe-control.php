<style>
/* ================================
   LOCKED DESKTOP VIEW IFRAME
================================ */
/*.calc-iframe-wrapper {
  width: 100%;
  overflow: hidden;
}*/

.calc-iframe-wrapper {
  max-width: 1200px;
  width:100%;
  overflow: hidden;
  /*display: flex;*/
  /*justify-content: center;*/
  border:0px solid blue;
}


.calc-iframe-wrapper iframe {
  width: 100%;       
  height: 100%;           
  border: 0px solid red;
  transform-origin: top left;
}

/* ================================
   SCALE FOR SMALL SCREENS
================================ */


/* @media (max-width: 1040px) {
  .calc-iframe-wrapper iframe {
    transform: scale(0.72) translateX(1.6%);
  }
}

@media (max-width: 640px) {
  .calc-iframe-wrapper iframe {
    transform: scale(0.3) translateX(9%)!important;
  }
} */
</style>


<script>
// function resizeIframeAfterScale() {
//   const iframe  = document.getElementById('paystub-frame');
//   const wrapper = iframe.parentElement;

//   const baseHeight = parseInt(iframe.dataset.baseHeight, 10);
//   let scale = 1;

//   if (window.innerWidth <= 640) {
//     scale = 0.3;
//     var perc = 6;
//   } else if (window.innerWidth <= 1040) {
//     scale = 0.72;
//     perc = 1.6;
//   }

//   // apply scale
//   iframe.style.transform = `scale(${scale}) translateX(${perc}%)`;
//   iframe.style.transformOrigin = 'top left';

//   // calculate *actual* visible height
//   const scaledHeight = baseHeight * scale;
//   // console.log("SH:",scaledHeight);

//   wrapper.style.height = scaledHeight + 'px';
// }

// window.addEventListener('resize', resizeIframeAfterScale);
// resizeIframeAfterScale();
</script>


<!-- <script>
(function () {

  const iframe  = document.getElementById('paystub-frame');
  const wrapper = document.getElementById('calc-iframe-wrapper');

  function getScale() {
    if (window.innerWidth <= 640) return { scale: 0.3, x: 14 };
    if (window.innerWidth <= 1040) return { scale: 0.72, x: 1.6 };
    return { scale: 1, x: 0 };
  }

  window.addEventListener("message", function (e) {
    if (!e.data || e.data.type !== "PAYSTUB_IFRAME_HEIGHT") return;

    const { scale, x } = getScale();

    iframe.style.transform =
      `scale(${scale}) translateX(${x}%)`;
    iframe.style.transformOrigin = 'top left';

    // 🔑 SCALE-AWARE height
    var iframe_height = e.data.height + "px";
    var iframe_wrapper_height = e.data.height * scale + "px";

    // console.log("setting iframe height:",iframe_height);
    // console.log("setting wrapper height:",iframe_wrapper_height);
    wrapper.style.height = iframe_wrapper_height ; //(e.data.height * scale) + "px";
    
    $('iframe#paystub-frame').css("height",iframe_height);
    $('iframe#paystub-frame').attr("data-base-height",iframe_height);
  });

  // Recalculate on resize
  window.addEventListener("resize", function () {
    iframe.contentWindow.postMessage("REQUEST_IFRAME_HEIGHT", "*");
  });

})();
</script>
 -->
