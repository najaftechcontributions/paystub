<style type="text/css">
  /* =====================================================
   STEP-1 FORM FIELDS
===================================================== */
  .pd-x {
    padding: 20px;
  }

  .input-div {
    margin-bottom: 18px;
  }

  .input-div > div:nth-child(1) {
    font-family: "PT Sans", sans-serif;
    font-size: 13px;
    font-weight: 700;
    margin: 8px 0;
  }

  .checkbox {
    cursor: pointer;
  }

  .checkbox:before {
    content: "\f0c8 \00a0";
    font-family: "Font Awesome 5 Pro";
    font-weight: 400;
    color: var(--theme);
    cursor: pointer;
  }

  .checkbox.checked:before {
    content: "\f14a \00a0";
    font-family: "Font Awesome 5 Pro";
    font-weight: 900;
  }

  [sdi-label="1"] {
    cursor: pointer;
  }

  /* Checkbox row (address toggle) */
  .checkbox-row {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .step1-checkbox {
    transform: scale(1.4);
    cursor: pointer;
    flex-shrink: 0;
  }

  .add-address-label {
    font-family: "PT Sans", sans-serif;
    font-size: 13px;
    font-weight: 700;
    color: #cb1219;
  }

  /* Deposit slip price */
  .deposit-price {
    font-family: "PT Sans", sans-serif;
    font-size: 13px;
    font-style: italic;
    font-weight: 700;
    color: #cb1219;
  }

  /* =====================================================
   PAYSTUB DOWNLOAD / INFO TEXT
===================================================== */
  .paystub-dwn {
    margin: auto;
    max-width: 80%;
    font-family: "PT Sans", sans-serif;
    font-size: 14px;
    font-weight: 500;
    color: #6f6f6f;
    text-align: center;
    line-height: 1.6;
  }

  /* =====================================================
   WATERMARK WRAPPER
===================================================== */
  .es-wrap-w {
    position: relative;
    background: #fff;
  }

  .wtmrk::before {
    content: "";
    position: absolute;
    inset: 0;
    background: url("lib/watermark.png") bottom center no-repeat;
    background-size: 88%;
    opacity: 0.07;
    pointer-events: none;
    z-index: 111;
  }

  .es-card,
  .es-actions {
    position: relative;
    z-index: 1;
  }

  .paystub-no-label {
    font-family: "PT Sans", sans-serif;
    font-size: 15px;
    font-weight: 700;
    text-align: center;
    margin: 10px 0 6px;
  }

  /* =====================================================
   HIDDEN PAYSTUB INPUT ROWS
===================================================== */
  [paystub-input] {
    display: none;
  }

  [addon-rows="income"] {
    display: none;
  }

  /* =====================================================
   ADDITIONAL PAYSTUB CARDS — 3 per row
===================================================== */
  .flex-addon-subs {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
  }

  .flex-addon-subs > div {
    flex: 0 0 calc((100% - 32px) / 3);
    min-width: 200px;
  }

  /* Card shell */
  .ps-box {
    border: 2px solid var(--blue);
    background: #fff;
    box-sizing: border-box;
  }

  .paystub-title {
    background: var(--blue);
    color: #fff;
    padding: 9px 12px;
    font-family: "PT Sans", sans-serif;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.3px;
  }

  .ps-body {
    padding: 12px;
  }

  /* Floating label field */
  .aps-inp {
    position: relative;
    margin-bottom: 16px;
  }

  .f-label {
    position: absolute;
    top: -7px;
    left: 10px;
    background: #fff;
    padding: 0 5px;
    font-family: "PT Sans", sans-serif;
    font-size: 11px;
    color: #777;
    letter-spacing: 0.4px;
  }

  /* Inputs inside additional cards */
  .ps-input {
    width: 100%;
    padding: 9px 8px;
    border: 1px solid #d6d6d6;
    font-family: "PT Sans", sans-serif;
    font-size: 13px;
    box-sizing: border-box;
    color: #222;
  }

  .ps-input:focus {
    outline: none;
    border-color: #0b84b4;
  }

  /* Pay period inline row */
  .period-row {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .ps-input.small {
    flex: 1;
  }

  .dash {
    font-family: "PT Sans", sans-serif;
    font-size: 13px;
    font-weight: 600;
    color: #555;
  }

  /* =====================================================
   RESPONSIVE — ≤ 880px
===================================================== */
  @media screen and (max-width: 880px) {
    .flex-addon-subs > div {
      flex: 0 0 calc((100% - 16px) / 2);
    }
  }

  /* =====================================================
   RESPONSIVE — ≤ 650px
===================================================== */
  @media screen and (max-width: 650px) {
    .input-div > div:nth-child(1) {
      font-size: 12px;
      margin: 5px 0;
    }

    .add-address-label,
    .deposit-price {
      font-size: 12px;
    }

    .pd-x {
      padding: 10px;
    }

    .paystub-dwn {
      max-width: 95%;
      font-size: 13px;
    }
  }

  /* =====================================================
   RESPONSIVE — ≤ 520px
===================================================== */
  @media screen and (max-width: 520px) {
    .flex-addon-subs {
      gap: 12px;
    }

    .flex-addon-subs > div {
      flex: 0 0 100%;
    }

    .paystub-title {
      font-size: 12px;
      padding: 8px 10px;
    }

    .ps-input {
      font-size: 12px;
      padding: 8px 6px;
    }

    .f-label {
      font-size: 10px;
    }
  }
</style>
