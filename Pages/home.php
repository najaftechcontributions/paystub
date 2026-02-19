<script src="<?php echo plugins_url('/../APP/JS/jquery.min.js', __FILE__); ?>"></script>

<?php
$RID = '';
if (isset($_GET['ref_id']) && !empty($_GET['ref_id'])) {
  $RID = "&ref_id=" . trim($_GET['ref_id']);
}
?>

<div class="ps-page-wrap">

  <!-- PayPal / Checkout panel (shown after preview) -->
  <div class="ps-checkout-panel" id="paypal-wrapper" happs-wrapper="paypal" style="visibility: hidden; display:none;">
    <div class="ps-congratulations">
      <p class="ps-congrats-heading">Congratulations! Your pay stubs have been created!</p>
      <p class="ps-congrats-sub">Your order is ready for purchase without a watermark. Click the PayPal button to receive your pay stub instantly via email, with both download and print options included.</p>
    </div>
    <?php include __DIR__ . '/../APP/STEPS/checkout-table.php'; ?>
    <?php include __DIR__ . '/../APP/pypl/btns.php'; ?>
  </div>

  <!-- iframe wrapper with loading overlay -->
  <div class="ps-iframe-outer" id="calc-iframe-wrapper">
    <div class="ps-iframe-loader" id="ps-iframe-loader">
      <div class="ps-spinner"></div>
      <p class="ps-loading-text">Loading Pay Stub Builder...</p>
    </div>
    <iframe
      id="paystub-frame"
      src="<?php echo plugins_url('/../APP/app.php?enable_addon=0' . $RID, __FILE__); ?>"
      class="ps-iframe"
      scrolling="no"
      loading="lazy"
      allowfullscreen>
    </iframe>
  </div>

</div>

<?php include __DIR__ . '/lib/btns-frame-control.php'; ?>
<?php include __DIR__ . '/lib/calc-iframe-control.php'; ?>

<script>
  window.PAYSTUB_AJAX = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>

<script>
  // ── Iframe loading overlay ────────────────────────────────────────
  (function () {
    const iframe = document.getElementById('paystub-frame');
    const loader = document.getElementById('ps-iframe-loader');
    if (!iframe || !loader) return;

    // Hide loader once iframe content is ready
    iframe.addEventListener('load', function () {
      loader.classList.add('ps-loader-hidden');
      iframe.classList.add('ps-iframe-visible');
    });

    // Fallback: hide loader after 6 seconds if load event never fires
    setTimeout(function () {
      loader.classList.add('ps-loader-hidden');
      iframe.classList.add('ps-iframe-visible');
    }, 6000);
  })();
</script>

<script>
  function fmtUSD(n) {
    return "$" + Number(n || 0).toFixed(2);
  }

  function computeTotals(paystubs, depositSlip) {
    const STUB = 4.99;
    const DEP  = 1.99;

    let stubQty = parseInt(paystubs || 1, 10);
    if (isNaN(stubQty) || stubQty < 1) stubQty = 1;

    const depQty   = depositSlip ? stubQty : 0;
    const stubTotal = stubQty * STUB;
    const depTotal  = depQty  * DEP;
    const grand     = stubTotal + depTotal;

    return { stubUnit: STUB, stubQty, stubTotal, depUnit: DEP, depQty, depTotal, grandTotal: grand };
  }

  function updateOrderSummaryTable(paystubs, depositSlip) {
    const wrap = document.getElementById("order-summary");
    if (!wrap) { console.warn("order-summary not found in parent DOM."); return; }

    const q          = (key) => wrap.querySelector('[data-os="' + key + '"]');
    const depositRow = wrap.querySelector('[data-os-row="deposit"]');

    const unitStub  = q("unit_stub");
    const qtyStub   = q("qty_stub");
    const totalStub = q("total_stub");
    const grandTotal = q("grand_total");

    if (!unitStub || !qtyStub || !totalStub || !grandTotal) {
      console.warn("Missing required data-os fields in order summary table.");
      return;
    }

    const t = computeTotals(paystubs, depositSlip);

    unitStub.textContent  = fmtUSD(t.stubUnit);
    qtyStub.textContent   = String(t.stubQty);
    totalStub.textContent = fmtUSD(t.stubTotal);

    if (depositRow) {
      if (depositSlip) {
        depositRow.classList.remove("os-hidden");
        const unitDep  = q("unit_deposit");
        const qtyDep   = q("qty_deposit");
        const totalDep = q("total_deposit");
        if (unitDep)  unitDep.textContent  = fmtUSD(t.depUnit);
        if (qtyDep)   qtyDep.textContent   = String(t.depQty);
        if (totalDep) totalDep.textContent = fmtUSD(t.depTotal);
      } else {
        depositRow.classList.add("os-hidden");
      }
    }

    grandTotal.textContent = fmtUSD(t.grandTotal);
    window.__checkoutState = { paystubs, depositSlip };
    console.log("Order summary updated:", { paystubs, depositSlip, totals: t });
  }

  // Receive state from iframe
  window.addEventListener("message", function (e) {
    const iframe = document.getElementById("paystub-frame");
    if (!iframe || e.source !== iframe.contentWindow) return;
    if (!e.data || e.data.type !== "CHECKOUT_STATE") return;

    const { preview, paystubs, depositSlip } = e.data;

    window.__checkoutState = { preview, paystubs, depositSlip };

    const pw = document.getElementById("paypal-wrapper");
    if (pw) pw.style.visibility = preview ? "visible" : "hidden";
    if (pw) pw.style.display = preview ? "flex" : "none";

    if (preview) updateOrderSummaryTable(paystubs, depositSlip);
  });
</script>

<script>
  // ── Auto-resize iframe via postMessage from inner app ─────────────
  // The inner app.php already sends PAYSTUB_IFRAME_HEIGHT on load,
  // resize and DOM mutations. We just consume it here.
  (() => {
    const iframe  = document.getElementById("paystub-frame");
    const outer   = document.getElementById("calc-iframe-wrapper");
    if (!iframe || !outer) return;

    let lastHeight = 0;

    function applyHeight(h) {
      if (!h || Math.abs(h - lastHeight) < 2) return;
      // Lock scroll position so the page doesn't jump
      const scrollY = window.scrollY;
      iframe.style.height = h + "px";
      outer.style.minHeight = h + "px";
      lastHeight = h;
      window.scrollTo({ top: scrollY, left: 0, behavior: "instant" });
    }

    // Primary: use postMessage height sent by the iframe
    window.addEventListener("message", function (e) {
      if (!e.data || e.data.type !== "PAYSTUB_IFRAME_HEIGHT") return;
      if (e.source !== iframe.contentWindow) return;
      applyHeight(e.data.height);
    });

    // On load, ask the iframe for its current height
    iframe.addEventListener("load", function () {
      iframe.contentWindow.postMessage("REQUEST_IFRAME_HEIGHT", "*");
      // Fallback measurements after a small delay for slow content
      setTimeout(function () {
        iframe.contentWindow.postMessage("REQUEST_IFRAME_HEIGHT", "*");
      }, 500);
      setTimeout(function () {
        iframe.contentWindow.postMessage("REQUEST_IFRAME_HEIGHT", "*");
      }, 1500);
    });

    // Re-request on parent resize
    window.addEventListener("resize", function () {
      if (iframe.contentWindow) {
        iframe.contentWindow.postMessage("REQUEST_IFRAME_HEIGHT", "*");
      }
    });
  })();
</script>

<script>
  function checkout_btns_optimizer() {
    setTimeout(function () {
      checkout_btns_optimizer();
    }, 100);
  }
  checkout_btns_optimizer();
</script>

<script>
  function happs_download_path(file) {
    var path = "<?php echo plugins_url('/../d/?pid=', __FILE__); ?>";
    return path + file;
  }

  function happs_ref_id_url(ref_id) {
    console.log("RID RECEIVED:", ref_id);
    const url = new URL(window.location.href);
    url.searchParams.set('ref_id', ref_id);
    window.history.replaceState({}, '', url);
  }
</script>

<style>
  @import url('https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap');

  /* ── Page wrapper ─────────────────────────────────── */
  .ps-page-wrap {
    font-family: "PT Sans", sans-serif;
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
    padding: 0 12px;
  }

  /* ── Checkout / PayPal panel ──────────────────────── */
  .ps-checkout-panel {
    width: 82%;
    max-width: 680px;
    margin: 0 auto 20px;
    flex-direction: column;
    align-items: center;
    position: relative;
  }

  .ps-congratulations {
    text-align: center;
    margin-bottom: 16px;
    padding: 16px 20px;
    background: #f0f9ff;
    border: 1px solid #bee3f8;
    border-radius: 6px;
    width: 100%;
  }

  .ps-congrats-heading {
    font-family: "PT Sans", sans-serif;
    font-size: 17px;
    font-weight: 700;
    color: #1a6fa3;
    margin: 0 0 8px;
  }

  .ps-congrats-sub {
    font-family: "PT Sans", sans-serif;
    font-size: 14px;
    font-weight: 400;
    color: #555;
    margin: 0;
    line-height: 1.5;
  }

  /* ── Iframe container ─────────────────────────────── */
  .ps-iframe-outer {
    position: relative;
    width: 100%;
    max-width: 100%;
    /* Reserve space while iframe loads so there's no jump */
    min-height: 600px;
    box-sizing: border-box;
  }

  .ps-iframe {
    width: 100%;
    border: 0;
    display: block;
    overflow: hidden;
    /* Start invisible but keep space reserved (no height collapse) */
    visibility: hidden;
    transition: visibility 0s, opacity 0.3s ease;
    opacity: 0;
  }

  .ps-iframe.ps-iframe-visible {
    visibility: visible;
    opacity: 1;
  }

  /* ── Loading overlay ──────────────────────────────── */
  .ps-iframe-loader {
    position: absolute;
    inset: 0;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: #fff;
    z-index: 10;
    transition: opacity 0.3s ease;
  }

  .ps-iframe-loader.ps-loader-hidden {
    opacity: 0;
    pointer-events: none;
  }

  /* ── Spinner ──────────────────────────────────────── */
  .ps-spinner {
    width: 42px;
    height: 42px;
    border: 4px solid #e0e0e0;
    border-top-color: #2da7d9;
    border-radius: 50%;
    animation: ps-spin 0.75s linear infinite;
    margin-bottom: 12px;
  }

  @keyframes ps-spin {
    to { transform: rotate(360deg); }
  }

  .ps-loading-text {
    font-family: "PT Sans", sans-serif;
    font-size: 14px;
    color: #888;
    margin: 0;
  }

  /* ── Responsive ───────────────────────────────────── */
  @media (max-width: 768px) {
    .ps-page-wrap {
      padding: 0 6px;
    }

    .ps-checkout-panel {
      width: 96%;
      max-width: 100%;
    }

    .ps-congrats-heading {
      font-size: 15px;
    }

    .ps-congrats-sub {
      font-size: 13px;
    }
  }

  @media (max-width: 480px) {
    .ps-page-wrap {
      padding: 0 4px;
    }

    .ps-congratulations {
      padding: 12px 14px;
    }

    .ps-congrats-heading {
      font-size: 14px;
    }

    .ps-congrats-sub {
      font-size: 12px;
    }
  }
</style>
