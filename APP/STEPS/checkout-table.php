<div id="order-summary" class="os-wrap" aria-live="polite">
  <h3 class="os-title">Order Summary</h3>

  <table class="os-table">
    <thead>
      <tr>
        <th class="os-center os-col-sno">S.No.</th>
        <th class="os-col-item">Particulars</th>
        <th class="os-center os-col-unit">Unit Cost</th>
        <th class="os-center os-col-qty">Qty</th>
        <th class="os-right os-col-total">Total</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td class="os-center">1.</td>
        <td>Regular Pay Stub</td>
        <td class="os-center" data-os="unit_stub">$4.99</td>
        <td class="os-center" data-os="qty_stub">1</td>
        <td class="os-right" data-os="total_stub">$4.99</td>
      </tr>

      <tr data-os-row="deposit" class="os-hidden">
        <td class="os-center">2.</td>
        <td>Deposit Slip</td>
        <td class="os-center" data-os="unit_deposit">$1.99</td>
        <td class="os-center" data-os="qty_deposit">1</td>
        <td class="os-right" data-os="total_deposit">$1.99</td>
      </tr>
    </tbody>

    <tfoot>
      <tr>
        <td colspan="4" class="os-right os-grand-label">Grand Total</td>
        <td class="os-right os-grand-total" data-os="grand_total">$4.99</td>
      </tr>
    </tfoot>
  </table>
</div>

<style>
  .os-wrap {
    font-size: 15px;
    max-width: 100%;
  }

  .os-title {
    margin: 0 0 10px;
    font-size: 18px;
    font-weight: 700;
  }

  .os-table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #969d9f;
    background: #fff;
  }

  .os-table th,
  .os-table td {
    border: 1px solid #969d9f;
    padding: 8px 10px;
    vertical-align: middle;
  }

  .os-table thead th {
    background: #dfdfdf;
    font-weight: 700;
  }

  .os-center {
    text-align: center;
  }

  .os-right {
    text-align: right;
  }

  .os-col-sno {
    width: 56px;
  }

  .os-col-item {
    width: auto;
  }

  .os-col-unit {
    width: 110px;
  }

  .os-col-qty {
    width: 70px;
  }

  .os-col-total {
    width: 130px;
  }

  .os-grand-label {
    font-weight: 700;
    background: #fafafa;
  }

  .os-grand-total {
    font-weight: 800;
    background: #fafafa;
  }

  .os-hidden {
    display: none;
  }

  /* Optional: small-screen friendliness */
  @media (max-width: 520px) {


    .os-table th,
    .os-table td {
      padding: 7px 8px;
    }

    .os-title {
      font-size: 16px;
    }
  }
</style>