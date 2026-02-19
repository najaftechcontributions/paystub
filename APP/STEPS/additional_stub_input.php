<div class="es-actions" action-btn="preview">

<div class="flex-addon-subs">
<?php for($i=2;$i<=12;$i++){ ?>
<div class="ps-box" paystub-input="<?= $i ?>">

  <div class="paystub-title">Pay Stub <?= $i ?></div>

  <div class="ps-body">

    <!-- CHECK NO -->
    <div class="aps-inp float">
      <span class="f-label">CHECK NO.</span>
      <input type="text" class="ps-input" i="check_no" pid="check_no_<?= $i ?>">
    </div>

    <!-- PAY DATE -->
    <div class="aps-inp float">
      <span class="f-label">PAY DATE</span>
      <input type="text" class="ps-input" idate="pay_date" pid="pay_date_<?= $i ?>" value="01/30/2026">
    </div>

    <!-- PAY PERIOD (2 inputs) -->
    <div class="aps-inp float">
      <span class="f-label">PAY PERIOD</span>
      <div class="period-row">
        <input type="text" class="ps-input small" pid="pay_start_<?= $i ?>" idate="pay_start" value="01/23/2026">
        <span class="dash">-</span>
        <input type="text" class="ps-input small" pid="pay_end_<?= $i ?>" idate="pay_end" value="01/29/2026">
      </div>
    </div>

    <!-- HOURS -->
    <div class="aps-inp float">
      <span class="f-label">NO. OF HOURS</span>
      <input type="text" class="ps-input" i="hours" pid="hours_<?= $i ?>" value="40">
    </div>

  </div>
</div>
<?php } ?>
</div>


<div class="es-actions" action-btn__="preview" no-print="1" additiona-btn="preview" style="display:none;">
      <button class="es-btn" type="submit" action_="preview-stub">PREVIEW STUB <i class="fa-solid fa-angles-right"></i>
      </button>
      <div class="es-note">
        <p>By clicking 'Preview Stub' button you are agreeing to the <u>Terms and Conditions</u>.</p>
      </div>
    </div>



</div>