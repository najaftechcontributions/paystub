<div class="es-wrap">

<div addon_paystub="1" class="stub-deposit-column"><?php include __DIR__.'/stub_template.php'; ?></div>

<div class="es-actions" action-btn="preview" no-print="1">
      <button class="es-btn" type="submit" action_="preview-stub">PREVIEW STUB <i class="fa-solid fa-angles-right"></i></button>
      <div class="es-note">
        <p>By clicking 'Preview Stub' button you are agreeing to the <u>Terms and Conditions</u>.</p>
      </div>
    </div>

<?php include __DIR__.'/additional_stub_input.php'; ?>



</div>


<div addon-paystubs-box="1" class="hide-imp">

<?php for($i=2;$i<=12;$i++){ ?>

<div class="es-wrap" addon_paystub="<?= $i ?>">
<h2 class="paystub-no-label">Paystub <?= $i ?></h2>
<div class="stub-deposit-column"  paystub-content="<?= $i ?>"><?php include __DIR__.'/stub_template.php'; ?></div>
</div>

<?php } ?>




</div>
<div class="es-actions hide" action-btn="download" no-print="1">
      <h2>Generating PDF, Please Wait...</h2>

  <p class="hide-imp">
    Your download will start automatically shortly. If it doesn't,
    <a href="/download/pdfs/">click here to download</a>.
</p>

</div>
