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
    font-family: "PT Sans", sans-serif;
    font-size: 14px;
    max-width: 100%;
    width: 100%;
    box-sizing: border-box;
    margin-bottom: 18px;
  }

  .os-title {
    font-family: "PT Sans", sans-serif;
    margin: 0 0 12px;
    font-size: 17px;
    font-weight: 700;
    color: #1a6fa3;
    letter-spacing: 0.3px;
  }

  .os-table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #bcc5cc;
    background: #fff;
    border-radius: 4px;
    overflow: hidden;
    font-family: "PT Sans", sans-serif;
  }

  .os-table th,
  .os-table td {
    border: 1px solid #bcc5cc;
    padding: 9px 11px;
    vertical-align: middle;
    font-family: "PT Sans", sans-serif;
    font-size: 13px;
  }

  .os-table thead th {
    background: #3F5F7F;
    color: #fff;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 0.3px;
    text-transform: uppercase;
  }

  .os-table tbody tr:hover {
    background: #f5faff;
  }

  .os-center {
    text-align: center;
  }

  .os-right {
    text-align: right;
  }

  .os-col-sno  { width: 48px; }
  .os-col-item { width: auto; }
  .os-col-unit { width: 100px; }
  .os-col-qty  { width: 60px; }
  .os-col-total { width: 110px; }

  .os-grand-label {
    font-weight: 700;
    background: #f0f4f8;
    color: #333;
    font-size: 13px;
  }

  .os-grand-total {
    font-weight: 800;
    background: #f0f4f8;
    color: #1a6fa3;
    font-size: 14px;
  }

  .os-hidden {
    display: none;
  }

  @media (max-width: 520px) {
    .os-table th,
    .os-table td {
      padding: 7px 7px;
      font-size: 12px;
    }

    .os-title {
      font-size: 15px;
    }

    .os-col-unit,
    .os-col-qty {
      width: auto;
    }
  }

  @media (max-width: 380px) {
    .os-table th,
    .os-table td {
      padding: 6px 5px;
      font-size: 11px;
    }
  }
</style>
