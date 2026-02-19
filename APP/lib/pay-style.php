<style>
  /* =====================================================
   ROOT VARIABLES (MERGED)
===================================================== */
  :root {
    --es-bg: #f5f5f5;
    --es-border: #d7d7d7;
    --es-dark: var(--es-head);
    --es-mid: #ededed;
    --es-head: #e0e0e0;
    --es-text: #222;

    /* Version 1 (dynamic blue) */
    --es-blue1: var(--blue);
    --es-blue2: var(--blue);

    /* Version 2 (static blue override if used later) */
    --es-blue1: #2da7d9;
    --es-blue2: #1a86b7;

    --es-white: white;
    --es-shadow: 0 2px 10px rgba(0, 0, 0, .08);
    --table-font: 13px;
  }

  /* =====================================================
   GLOBAL RESET
===================================================== */
  *,
  *::before,
  *::after {
    box-sizing: border-box;
  }

  .es-wrap {
    color: var(--es-text);
  }

  .es-card {
    max-width: 100%;
    width: 100%;
    margin: 0 auto;
    background: #fff;
    padding: 15px;
  }

  .card {
    box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.1) !important;
  }

  /* =====================================================
   TOP RIBBON
===================================================== */
  .es-ribbon {
    display: flex;
    justify-content: space-between;
    align-items: stretch;
    padding-bottom: 5px;
  }

  .es-check {
    width: 100%;
    border: 0;
    padding: 2px 0px;
    border-bottom: 1px solid var(--es-border);
    ;
    font-size: 14px;
    color: black;
  }

  .es-title {
    margin-left: auto;
    width: max-content;
    text-align: right;
    font-weight: 800;
    font-size: 16px;
    letter-spacing: .8px;
    color: black;
    padding: 4px 0px;
  }

  /* =====================================================
   GRID LAYOUT
===================================================== */
  .es-grid {
    background: var(--es-bg);
  }

  .es-row {
    display: grid;
    background: white;
  }

  .es-row.es-1 {
    grid-template-columns: 1fr;
  }

  .es-row.es-2 {
    grid-template-columns: 1fr 1fr;
  }

  .es-row.es-4 {
    grid-template-columns: 1fr 1fr 1fr 1fr;
  }

  .es-row.es-6 {
    grid-template-columns: 1fr 1.2fr 1fr 1.2fr 1.5fr .7fr;
  }

  /* .es-row.es-6 .input-inner-padding{
    background-color: #D7D7D7;
   } */
  .es-row.es-6 input {
    background-color: transparent;
  }



  .es-row.es-payrow {
    grid-template-columns: 1.1fr 2fr 1fr 1fr;
  }

  /* =====================================================
   CELLS
===================================================== */
  .es-cell {
    background-color: white !important;
  }

  .es-row .es-cell:last-child {
    border-right: 0;
  }

  /* =====================================================
   HEADERS
===================================================== */
  .es-h {
    background: white;
    padding: 5px 0;
    font-size: 13px;
    font-weight: 700;
  }

  .es-h2 {
    font-size: 14px;
    font-weight: 700;
  }

  /* =====================================================
   INPUTS / SELECTS
===================================================== */
  .es-in,
  .es-in-sm,
  .es-in-md,
  select {
    width: 100%;
    margin: 2px 0;
    padding: 6px 8px;
    border: none;
    border-bottom: 1px solid #cfcfcf;
    font-size: 12px;
    background: #fff;
    font-weight: 400;
  }

  .es-cell select {
    padding-bottom: 4.5px;
  }

  .input-inner-padding {
    padding: 0px 5px;
  }

  .es-in-sm {
    text-align: right;
  }

  .es-in-md {
    max-width: 120px;
    text-align: right;
  }

  .es-inline {
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .es-right {
    justify-content: flex-end;
  }

  .es-ssnmask {
    font-size: 14px;
    color: #666;
    white-space: nowrap;
  }

  /* =====================================================
   UTILITY CLASSES (FROM SECOND FILE)
===================================================== */
  /* .m-t-8 {
    margin-top: 10px;
    margin-bottom: 10px;
    margin-right: 5px;
  } */

  .grey-bg {
    background: #3F5F7F !important;
  }

  .white-text {
    color: white !important;
    font-size: 12px;
  }

  .white-bg {
    background: white;
  }

  .transparent-input {
    background: transparent;
    border: none;
    color: white;
  }

  .transparent-input-clr-blck {
    background: transparent;
    border: none;
    color: black;
    margin: 0;
    text-align: left;
  }

  .border-none {
    border: none;
  }

  .input-border-top-bottom {
    border-left: none;
    border-right: none;
  }

  .border-btm {
    border-bottom: 1px solid var(--es-border);
  }

  .padding-r {
    padding-right: 6px;
  }

  .padding-l {
    padding-left: 6px;
  }

  .padding-l-8 {
    padding-left: 8px;
  }

  .zero-pad-marg {
    margin: 0;
    padding: 0;
  }

  .row-gap {
    gap: 5px;
  }

  .cmp-name {
    font-weight: 700;
  }

  .flex {
    display: flex;
  }

  .flex-row {
    flex-direction: row;
  }

  .flex-col {
    flex-direction: column;
  }

  .flex-gap-5 {
    gap: 5px;
  }

  .p-margin p {
    margin: 0px !important;
  }

  .p-weight {
    font-weight: 700;
  }

  .margin-0 {
    margin: 0px !important;
  }

  /* =====================================================
   EARNINGS / DEDUCTIONS TABLES
===================================================== */
  .es-middle {
    display: grid;
    grid-template-columns: 1fr 1fr;
    background: var(--es-bg);
  }

  .es-subhead {
    display: grid;
    grid-template-columns: 1.6fr .9fr .9fr .9fr;
    background: var(--es-dark);
    color: var(--es-text);
    font-size: 12px;
    font-weight: 700;
    padding: 6px 8px;
  }

  .es-subhead-d {
    grid-template-columns: 1.8fr 1fr 1fr;
  }

  .es-table {
    padding-right: 5px;
  }

  .es-tr {
    display: grid;
    grid-template-columns: 1.6fr .9fr .9fr .9fr;
    gap: 6px;
    align-items: center;
    padding: 4px 0;
  }

  .es-table-d .es-tr {
    grid-template-columns: 1.8fr 1fr 1fr;
  }



  /* Ensure the grid layout is working properly */
  .es-table-d {
    display: grid;
    grid-template-columns: 1.8fr 1fr 1fr;
    width: 100%;
    border-left: 1px solid #ccc;
    
  }

  /* Additional styling for the inputs and table */
  .es-table-d .es-td input {
    width: 100%;
    border-bottom: 1px solid #ccc;
    border-radius: 3px;
    background-color: transparent;
  }

  .es-table-d .es-tr {
    display: contents;
    /* Ensures the grid works with rows */
    border-bottom: 1px solid #ccc;
  }


  .es-table-d .hide-imp {
    display: none;
  }

  .es-table-d .es-tr:hover {
    background-color: #f5f5f5;
  }

  .es-td.es-lbl {
    font-size: 13px;
    font-weight: 400;
    margin: auto 0;
  }

  /* =====================================================
   FOOTER / TOTALS (FINAL OVERRIDES)
===================================================== */
  .es-bottom {
    display: grid;
    grid-template-columns: 1fr 1fr;
    background: var(--es-white);
  }

  .es-gross {
    grid-column: 1 / 2;
    display: grid;
    grid-template-columns: 1.6fr .9fr .9fr;
    align-items: center;
    padding: 8px;
    border-top: 1px solid var(--es-border);
    border-right: 1px solid var(--es-border);
  }

  .es-cell.es-gross {
    border: none;
  }

  .es-totalded,
  .es-net {
    grid-column: 2 / 3;
    display: grid;
    grid-template-columns: 1.6fr .9fr .9fr;
    align-items: center;
    padding: 8px;
    border-top: 1px solid var(--es-border);
  }

  .es-gross .es-h2,
  .es-totalded .es-h2,
  .es-net .es-h2 {
    grid-column: 1 / 2;
  }

  .es-gross .es-inline,
  .es-totalded .es-inline,
  .es-net .es-inline {
    grid-column: 2 / 4;
    justify-content: flex-end;
    gap: 6px;
  }

  .es-in-md {
    max-width: 77px;
  }

  .es-totalded input,
  .es-net input {
    max-width: fit-content;
  }

  .es-bottom .es-cell {
    background-color: var(--es-white);
  }

  /* =====================================================
   ACTIONS
===================================================== */
  .es-actions {
    padding: 12px 0 8px;
    text-align: center;
    background: #fff;
  }

  .hide {
    padding-bottom: 20px;
    align-self: end;
  }

  .es-btn {
    border: 0;
    padding: 10px 24px;
    color: #fff;
    font-weight: 700;
    border-radius: 4px;
    cursor: pointer;
    background: linear-gradient(180deg, var(--es-blue1), var(--es-blue2));
  }

  .es-note {
    margin-top: 6px;
    font-size: 12px;
  }

  [label="responsive"] {
    display: none;
  }


  /* DEPOSIT SLIP */
  .deposit-slip {
    width: 100%;
    max-width: 100%;
    margin: 30px 0px 50px 0px;
    /* margin: 18px auto 0; */
    background: #f5f5f5;
    border: 1px solid #d9d9d9;
    border-radius: 6px;
    padding: 18px 18px 12px;
    font-family: Arial, Helvetica, sans-serif;
    color: #222;
    box-sizing: border-box;
  }

  .stub-deposit-column {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .txt-lft {
    text-align: left !important;
  }


  .ds-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 14px;
  }



  .ds-company {
    font-size: 18px;
    font-weight: 800;
    margin-bottom: 4px;
  }



  .ds-company-sub {
    font-size: 13px;
    color: #444;
  }



  .ds-right {
    min-width: 260px;
    text-align: right;
  }



  .ds-meta-row {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 12px;
    margin-bottom: 6px;
  }



  .ds-meta-label {
    font-size: 14px;
    font-weight: 800;
    color: #333;
  }



  .ds-meta-value {
    min-width: 120px;
    text-align: center;
    background: #fff;
    border: 1px solid #d0d0d0;
    padding: 6px 8px;
    font-size: 12px;
    border-radius: 3px;
  }



  .ds-mid {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 10px 0 14px;
  }



  .ds-pay-label {
    font-size: 13px;
    font-weight: 700;
    color: #333;
    min-width: 34px;
  }



  .ds-amount-words {
    flex: 1;
    background: #fff;
    border: 1px solid #d0d0d0;
    padding: 10px 12px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 3px;
    line-height: 1.2;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }



  .ds-amount-box {
    min-width: 140px;
    text-align: center;
    background: #fff;
    border: 1px solid #d0d0d0;
    padding: 10px 10px;
    font-size: 18px;
    font-weight: 700;
    border-radius: 3px;
  }



  .ds-bottom {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 14px;
    margin-top: 6px;
  }



  .ds-payee {
    flex: 1;
  }



  .ds-payee-label {
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 6px;
    color: #333;
  }



  .ds-payee-box {
    display: inline-block;
    min-width: 220px;
    background: #fff;
    border: 1px solid #d0d0d0;
    padding: 8px 10px;
    border-radius: 3px;
    font-size: 18px;
    font-weight: 700;
  }



  .ds-badge {
    text-align: right;
    min-width: 240px;
  }



  .ds-badge-title {
    font-size: 18px;
    font-weight: 900;
    letter-spacing: 0.5px;
  }



  .ds-badge-sub {
    font-size: 12px;
    font-weight: 700;
    color: #333;
    margin-top: 2px;
  }



  .ds-footer {
    text-align: center;
    font-size: 12px;
    font-weight: 700;
    color: #333;
    margin-top: 14px;
    letter-spacing: 0.6px;
  }

  .card-padding {
    padding: 20px;
  }

  @media (max-width:1000px) {
    .white-text {
      font-size: 11px;
    }

    .es-in,
    .es-in-sm,
    .es-in-md,
    select {
      padding: 6px 2px;
      font-size: 11px;
    }

    .es-td.es-lbl {
      font-size: 11px;
    }

    .card-padding {
      padding: 15px;
    }

    .input-div {
      font-size: 12px;
    }

    .flexer-1 {
      gap: 20px;
    }
  }

  @media (max-width:880px) {
    .flexer-1 {
      flex-direction: column;
      gap: 30px;
    }

    .grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
      align-items: end;
    }

    .cst-order {
      order: 5;
      grid-column: 1 / -1 !important;
    }

    .input-div {
      margin-bottom: 10px !important;
    }

    #step-1,
    #step-2 {
      width: 100%;
    }

    .es-title {
      font-size: 14px
    }

    .es-check {
      font-size: 12px;
    }
  }

  @media (max-width:650px) {
    .es-card{
          padding: 10px;
    }
    .es-title {
      font-size: 11px
    }

    .es-td.es-lbl {
      font-size: 8px;
    }

    .ds-badge-title {
      font-size: 12px;
    }

    .ds-badge {
      min-width: 70%;
    }

    .ds-payee {
      width: 30%;
    }

    .ds-company,
    .ds-payee-box {
      font-size: 10px;
    }

    .ds-amount-words,
    .ds-amount-box,
    .ds-meta-value,
    .ds-payee-box {
      padding: 5px 8px !important;
      font-size: 8px;
    }

    .ds-meta-label,
    .ds-pay-label,
    .ds-payee-label,
    .ds-badge-sub,
    .ds-company-sub {
      font-size: 8px;
    }

    .input-div>div:nth-child(1) {
      margin: 5px 0px;
    }

    .ds-payee {
      width: 50%;
    }

    .ds-payee-box {
      min-width: 100%;
    }

    .ds-pay-label {
      width: 5%;
    }

    .ds-amount-words {
      width: 70%;
    }

    .ds-amount-box {
      min-width: 25%;
    }

    .es-check {
      font-size: 8px;
    }

    .white-text {
      font-size: 6px !important;
    }

    .es-in,
    .es-in-sm,
    .es-in-md,
    select {
      padding: 6px 2px;
      font-size: 8px;
    }

    .es-card input::placeholder {
      font-size: 8px !important;
    }

    .es-btn {
      font-size: 10px;
    }
  }



  /* Mobile */
  /* @media (max-width:640px) {

    .ds-top,
    .ds-bottom {
      flex-direction: column;
      align-items: stretch;
      text-align: left;
    }

    .ds-right {
      text-align: left;
      min-width: auto;
    }

    .ds-meta-row {
      justify-content: flex-start;
    }

    .ds-mid {
      flex-direction: column;
      align-items: stretch;
    }

    .ds-amount-box {
      width: 100%;
    }

    .ds-amount-words {
      white-space: normal;
    }

    .ds-badge {
      text-align: left;
    }
  } */
</STYLE>