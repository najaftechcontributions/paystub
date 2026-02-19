<script src="<?php echo plugins_url('/../APP/JS/jquery.min.js', __FILE__); ?>"></script>

<?php
$RID = '';
if (isset($_GET['ref_id']) && !empty($_GET['ref_id'])) {
  $RID = "&ref_id=" . trim($_GET['ref_id']);
}

?>
<div class="flex flex-col">
  <div class="flex cst-transform">
    <div id="paypal-wrapper" happs-wrapper="paypal" style="visibility: hidden;">
      <div class="paystub-dwn">
        <p>Congratulations! Your pay stubs have been created!</p>
        <p>Your order is ready for purchase without a watermark. Click the Paypal button to receive your pay stub
          instantly via email, with both download and print options included.</p>
      </div>
      <?php include __DIR__ . '/../APP/STEPS/checkout-table.php'; ?>
      <?php include __DIR__ . '/../APP/pypl/btns.php'; ?>
    </div>
  </div>

  <div class="calc-iframe-wrapper" id="calc-iframe-wrapper">
    <iframe id="paystub-frame"
      src="http://paystub.local/wp-content/plugins/bestpaystub-calculator/Pages/../APP/app.php?enable_addon=0"
      style="width:100%; border:0; display:block; overflow:hidden;" scrolling="no" loading="lazy"
      allowfullscreen></iframe>
  </div>
</div>


<?php include __DIR__ . '/lib/btns-frame-control.php'; ?>
<?php include __DIR__ . '/lib/calc-iframe-control.php'; ?>


<script>
  window.PAYSTUB_AJAX = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>

<script>
  function fmtUSD(n) {
    return "$" + Number(n || 0).toFixed(2);
  }

  // Single source of truth for table totals
  function computeTotals(paystubs, depositSlip) {
    const STUB = 4.99;
    const DEP = 1.99;

    let stubQty = parseInt(paystubs || 1, 10);
    if (isNaN(stubQty) || stubQty < 1) stubQty = 1;

    // ✅ Deposit is ONLY qty 1 if checked (your requirement)
    const depQty = depositSlip ? stubQty : 0;

    const stubTotal = stubQty * STUB;
    const depTotal = depQty * DEP;
    const grand = stubTotal + depTotal;

    return {
      stubUnit: STUB, stubQty, stubTotal,
      depUnit: DEP, depQty, depTotal,
      grandTotal: grand
    };
  }

  function updateOrderSummaryTable(paystubs, depositSlip) {
    const wrap = document.getElementById("order-summary");
    if (!wrap) {
      console.warn("order-summary not found in parent DOM.");
      return;
    }

    const q = (key) => wrap.querySelector('[data-os="' + key + '"]');
    const depositRow = wrap.querySelector('[data-os-row="deposit"]');

    // Required nodes (prevents your null.textContent error)
    const unitStub = q("unit_stub");
    const qtyStub = q("qty_stub");
    const totalStub = q("total_stub");
    const grandTotal = q("grand_total");

    if (!unitStub || !qtyStub || !totalStub || !grandTotal) {
      console.warn("Missing required data-os fields in order summary table.");
      return;
    }

    const t = computeTotals(paystubs, depositSlip);

    unitStub.textContent = fmtUSD(t.stubUnit);
    qtyStub.textContent = String(t.stubQty);
    totalStub.textContent = fmtUSD(t.stubTotal);

    if (depositRow) {
      if (depositSlip) {
        depositRow.classList.remove("os-hidden");
        const unitDep = q("unit_deposit");
        const qtyDep = q("qty_deposit");
        const totalDep = q("total_deposit");
        if (unitDep) unitDep.textContent = fmtUSD(t.depUnit);
        if (qtyDep) qtyDep.textContent = String(t.depQty);   // ✅ will be 1
        if (totalDep) totalDep.textContent = fmtUSD(t.depTotal);
      } else {
        depositRow.classList.add("os-hidden");
      }
    }

    grandTotal.textContent = fmtUSD(t.grandTotal);

    // store for PayPal later (we'll use this next)
    window.__checkoutState = { preview, paystubs, depositSlip };


    console.log("Order summary updated:", { paystubs, depositSlip, totals: t });
  }

  // Receive state from iframe
  window.addEventListener("message", function (e) {
    // ✅ Only accept messages coming from our iframe
    const iframe = document.getElementById("paystub-frame");
    if (!iframe || e.source !== iframe.contentWindow) return;

    if (!e.data || e.data.type !== "CHECKOUT_STATE") return;

    const { preview, paystubs, depositSlip } = e.data;

    // store state
    window.__checkoutState = { preview, paystubs, depositSlip };

    const pw = document.getElementById("paypal-wrapper");
    if (pw) pw.style.visibility = preview ? "visible" : "hidden";

    if (preview) {
      updateOrderSummaryTable(paystubs, depositSlip);
    }
  });



</script>

<script>
  (() => {
    const iframe = document.getElementById("paystub-frame");
    if (!iframe) return;

    let lastHeight = 0;
    let rafScheduled = false;
    let ro;

    function measureHeight(doc) {
      return Math.max(
        doc.body?.scrollHeight || 0,
        doc.documentElement?.scrollHeight || 0,
        doc.body?.offsetHeight || 0,
        doc.documentElement?.offsetHeight || 0
      );
    }

    function applyHeight(newHeight) {
      // Ignore tiny changes (helps reduce jitter)
      if (!newHeight || Math.abs(newHeight - lastHeight) < 2) return;

      // Preserve the parent scroll position
      const y = window.scrollY;

      iframe.style.height = newHeight + "px";
      lastHeight = newHeight;

      // Restore scroll (prevents “page moves while resizing” feeling)
      window.scrollTo({ top: y, left: 0, behavior: "auto" });
    }

    function scheduleResize() {
      if (rafScheduled) return;
      rafScheduled = true;

      requestAnimationFrame(() => {
        rafScheduled = false;
        try {
          const doc = iframe.contentDocument || iframe.contentWindow.document;
          if (!doc) return;
          applyHeight(measureHeight(doc));
        } catch (e) {
          // Same-origin required
        }
      });
    }

    iframe.addEventListener("load", () => {
      scheduleResize();

      const win = iframe.contentWindow;
      const doc = iframe.contentDocument || win.document;

      // Disconnect if reloaded
      if (ro) ro.disconnect();

      // Observe size changes inside iframe
      if (win.ResizeObserver) {
        ro = new win.ResizeObserver(() => scheduleResize());
        ro.observe(doc.documentElement);
      } else {
        // Fallback: poll (rarely needed)
        setInterval(scheduleResize, 250);
      }

      // Extra passes for late fonts/images
      setTimeout(scheduleResize, 200);
      setTimeout(scheduleResize, 800);
    });

    window.addEventListener("resize", scheduleResize);
  })();
</script>



<script>
  function checkout_btns_optimizer() {
    setTimeout(function () {
      // console.log("checking height...");
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

    // Update URL without reload
    window.history.replaceState({}, '', url);
  }



  // function happs_iframe_dynamic_resizer(is_nj = 0) {

  //   // var iframe = $('#paystub-frame');
  //   // var iframe_wrapper = $('#calc-iframe-wrapper');
  //   // var height = 920;

  //   //  if(is_nj == "0"){height = 850;}

  //   // iframe.attr("data-base-height",height);
  //   // iframe_wrapper.css("height",height + "px")
  // }
</script>
<style>
  .flex {
    display: flex;
    max-width: 100%;
    align-items: center;

  }

  .flex-row {
    flex-direction: row;
  }

  .flex-col {
    flex-direction: column;
    padding: 0px 10px;
  }

  .cst-transform {
    width: 930px;
  }
</style>