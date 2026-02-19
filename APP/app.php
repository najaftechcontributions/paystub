<!DOCTYPE html>
<html>
<head>
	<title></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
@import url('https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap');
</style>


<link rel="stylesheet" type="text/css" href="https://calculatorexpress.com/Euploads/ICONS/icons.css"> 

<script type="text/javascript" src="JS/isend.min.js"></script>
<script type="text/javascript" src="JS/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="BIN/style.css?v=1.2">
<link rel="stylesheet" type="text/css" href="BIN/button.css">
<link rel="stylesheet" type="text/css" href="lib/custom.css?v=3.1">

<script type="text/javascript" src="BIN/formatters.js?v=2.6"></script>

<link rel="stylesheet" href="JS/tooltips/jquery-ui.css">
<link rel="stylesheet" href="JS/tooltips/style.css">
<script src="JS/tooltips/jquery-ui.js"></script>

<link rel="stylesheet" href="JS/date/jquery-ui.css">
<link rel="stylesheet" href="JS/date/style.css">
<script src="JS/date/jquery-ui.js"></script>



<link rel="stylesheet" type="text/css" href="lib/loader.css">

<style type="text/css">
  :root {
    --grey: #82878a;
    --theme: var(--grey);
    --blue: #356C94;
    --green: #304a89;
    --theme-grey: #232931;
    --default-font: "PT Sans", sans-serif;
    --input-font: "PT Sans", sans-serif;
    --sliders: var(--theme);
  }

  html, body {
    font-family: "PT Sans", sans-serif;
    font-size: 14px;
    margin: 0;
    padding: 0;
    background: #fff;
  }

  body * {
    font-family: "PT Sans", sans-serif;
  }

  input, select, textarea, button {
    font-family: "PT Sans", sans-serif;
  }

  .hide { display: none; }
  .solid-hide { visibility: hidden; }
</style>

<?php include 'lib/function.php'; ?>
<?php include 'lib/states.php'; ?>
<?php include 'lib/style.php'; ?>
<?php include 'check_ref_id.php'; ?>

<?php include 'lib/pay-style.php'; ?>
<?php include 'lib/paystub-css2.php'; ?>
<style>
    .hide-imp{display: none;}
</style>
<script>
var pdf_uid = null;
var custom_height = 0;
</script>
<?php $vx = time(); ?>

<script>
  function GET_V(key) {
  const params = new URLSearchParams(window.location.search);
  return params.get(key); // returns null if not found
}

  const STORAGE_KEY = 'paystub_ref_id';
  var ref_id_valid = <?php echo $ref_id_valid; ?>;
  
  // let ref_id = GET_V("ref_id") || localStorage.getItem(STORAGE_KEY);
 if(ref_id_valid == "1"){
  console.log("ref_id is valid");
  var ref_id = GET_V("ref_id");
}else{
  // ref_id = localStorage.getItem(STORAGE_KEY);
 }

  if (!ref_id) {
    ref_id = Date.now().toString(); // current timestamp (ms)
    localStorage.setItem(STORAGE_KEY, ref_id);
  }

  window.ref_id = ref_id;
  console.log("ref_id:", ref_id);
</script>

</head>

<body>

<form id="data-form" onsubmit="do_preview();return false;">
<div class="main-1" id="calc-main-content">

<div class="flexer-1">
<div id="step-1" class="shadow_"><?php include 'STEPS/1.php'; ?></div>
<div id="step-2" class="shadow_"><?php include 'STEPS/2.php'; ?></div>
</div>

</div>
</form>

<style type="text/css">
  .main-1 {
    padding: 12px 10px;
    box-sizing: border-box;
    max-width: 100%;
  }

  .flexer-1 {
    display: flex;
    justify-content: space-between;
    gap: 24px;
  }

  .flexer-1 > div:nth-child(1) { width: 25%; height: 100%; }
  .flexer-1 > div:nth-child(2) { width: 75%; }

  @media screen and (max-width: 880px) {
    .flexer-1 {
      flex-direction: column;
      gap: 18px;
    }
    .flexer-1 > div:nth-child(1),
    .flexer-1 > div:nth-child(2) {
      width: 100%;
    }
  }

  @media screen and (max-width: 600px) {
    .main-1 {
      padding: 8px 6px;
    }
    .flexer-1 {
      gap: 12px;
    }
  }
</style>

<script type="text/javascript">
// -----------------------------------------------------------
  $(document).on("change",".dollar",function() {

  // var x = this.value;

  var x = FORMAT_SYM(this.value);
      x = INT(x);
  $(this).val(x);

});

   $(document).on("change",".intx",function() {

  // var x = this.value;

  var x = FORMAT_SYM(this.value);
      x = INTX(x);
  $(this).val(x);

});


$( ".perc" ).change(function() {
var x = FORMAT_SYM(this.value);
      x = x+'%';
  $(this).val(x);
});


</script>





<script> $( function() { $( document ).tooltip({tooltipClass: "tooltip",}); } ); </script>
<script>
  $('[date-field],[paystub-input] [idate]').datepicker({
    dateFormat: 'mm/dd/yy'
}).datepicker('setDate', new Date());
</script>


<script src="app.js?v=<?php echo $vx; ?>"></script>
<script src="download/download-js.js?v=<?php echo $vx; ?>"></script>
<script type="text/javascript" src="lib/required-fields.js?v=<?php echo $vx; ?>"></script>

<script type="text/javascript" src="print/print.js?v=<?php echo $vx; ?>"></script>
<link rel="stylesheet" type="text/css" href="print/print.css?v=<?php echo $vx; ?>">

<script>document.addEventListener('contextmenu', event => event.preventDefault());</script>


<script>

  function sendHeight() {

var height = document.documentElement.scrollHeight;
if(custom_height != "0"){height = custom_height; custom_height = 0;}
// ----------------------------------
// var box_visible = $('[addon-paystubs-box="1"]').is(":visible");
// if(!box_visible){height = 800;}
// if(mass_drop && !box_visible){height = 800;mass_drop = 0;}
//------------------------------------
    // console.log("Height:",height);
    window.parent.postMessage(
      { type: "PAYSTUB_IFRAME_HEIGHT", height: height },
      "*"
    );
  }

  window.addEventListener("load", sendHeight);
  window.addEventListener("resize", sendHeight);

  // Watch for dynamic changes (AJAX, toggles, addons, etc.)
  const observer = new MutationObserver(sendHeight);
  observer.observe(document.body, {
    childList: true,
    subtree: true,
    attributes: true
  });

  // Optional: allow parent to request height
  window.addEventListener("message", function (e) {
    if (e.data === "REQUEST_IFRAME_HEIGHT") {
      sendHeight();
    }
  });



</script>

</body>
</html>
