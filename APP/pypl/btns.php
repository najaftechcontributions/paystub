<?php include __DIR__."/functions.php"; ?>

<div class="paypal-cst-cont">
  <div id="paypal-button-container"></div>
</div>

<script src="https://www.paypal.com/sdk/js?client-id=<?php echo credentials()['client']; ?>&currency=USD&disable-funding=paylater"></script>

<script><?php echo create_pypl_js(); ?></script>