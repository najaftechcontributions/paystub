<style>
  /* =====================================================
   ROOT VARIABLES
===================================================== */
  :root {
    --es-bg: #f5f5f5;
    --es-border: #d7d7d7;
    --es-dark: var(--es-head);
    --es-mid: #ededed;
    --es-head: #e0e0e0;
    --es-text: #222;
    --es-blue1: #2da7d9;
    --es-blue2: #1a86b7;
    --es-white: white;
    --es-shadow: 0 2px 10px rgba(0, 0, 0, .08);
    --es-font: "PT Sans", sans-serif;
    --es-header-bg: #dfdfdf;

    /* Font size scale — tweak these to shift everything together */
    --fs-xs: 10px;
    --fs-sm: 13px;
    --fs-base: 14px;
    --fs-md: 14px;
    --fs-lg: 15px;
  }

  /* =====================================================
   GLOBAL RESET + FONT
===================================================== */
  *,
  *::before,
  *::after {
    box-sizing: border-box;
  }

  .es-wrap,
  .es-wrap *,
  .es-card,
  .es-card *,
  .es-actions,
  .es-actions * {
    font-family: var(--es-font);
  }

  .fa-classic,
  .fa-regular,
  .fa-solid,
  .far,
  .fas {
    font-family: "Font Awesome 6 Free" !important;
  }

  .es-wrap {
    color: var(--es-text);
  }

  .es-card {
    max-width: 100%;
    width: 100%;
    margin: 0 auto;
    background: #fff;
    padding: 16px;
    border-radius: 4px;
  }

  .card {
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1) !important;
  }

  /* =====================================================
   TOP RIBBON
===================================================== */
  .es-ribbon {
    display: flex;
    justify-content: space-between;
    align-items: stretch;
    padding-bottom: 8px;
    border-bottom: 2px solid var(--es-header-bg);
    margin-bottom: 6px;
  }

  .es-check {
    width: 100%;
    border: 0;
    padding: 3px 0;
    border-bottom: 1px solid var(--es-border);
    font-family: var(--es-font);
    font-size: var(--fs-base);
    color: #222;
  }

  .es-check::placeholder {
    font-family: var(--es-font);
    font-size: var(--fs-sm);
    color: #aaa;
  }

  .es-title {
    margin-left: auto;
    width: max-content;
    text-align: right;
    font-family: var(--es-font);
    font-weight: 800;
    font-size: var(--fs-md);
    letter-spacing: 1px;
    color: var(--es-header-bg);
    padding: 4px 0;
    text-transform: uppercase;
  }

  /* =====================================================
   GRID LAYOUT
===================================================== */
  .es-grid {
    background: var(--es-bg);
    border: 1px solid var(--es-border);
    border-radius: 3px;
    overflow: hidden;
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
    border-right: 1px solid var(--es-border);
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
    font-family: var(--es-font);
    font-size: var(--fs-xs);
    font-weight: 700;
    letter-spacing: 0.3px;
    text-transform: uppercase;
    line-height: 1.3;
  }

  .es-h2 {
    font-family: var(--es-font);
    font-size: var(--fs-sm);
    font-weight: 700;
  }

  /* =====================================================
   INPUTS / SELECTS
===================================================== */
  .es-in,
  .es-in-sm,
  .es-in-md,
  .es-cell select {
    width: 100%;
    margin: 2px 0;
    padding: 5px 6px;
    border: none;
    border-bottom: 1px solid #e0e0e0;
    font-family: var(--es-font);
    font-size: var(--fs-base);
    font-weight: 400;
    background: #fff;
    color: #222;
    line-height: 1.4;
  }

  .es-cell select {
    padding-bottom: 4px;
    cursor: pointer;
  }

  .es-cell input::placeholder {
    font-family: var(--es-font);
    font-size: var(--fs-sm);
    color: #bbb;
  }

  .input-inner-padding {
    padding: 0 5px;
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

  .es-dash {
    font-family: var(--es-font);
    font-size: var(--fs-base);
    color: #666;
    flex-shrink: 0;
  }

  .es-ssnmask {
    font-size: var(--fs-base);
    color: #666;
    white-space: nowrap;
  }

  /* =====================================================
   UTILITY CLASSES
===================================================== */
  .grey-bg {
    background: var(--es-header-bg) !important;
  }

  .white-text {
    color: #000 !important;
    font-size: var(--fs-xs);
    font-family: var(--es-font);
    font-weight: 700;
    letter-spacing: 0.3px;
  }

  .white-bg {
    background: white;
  }

  .transparent-input {
    background: transparent;
    border: none;
    color: white;
    font-family: var(--es-font);
  }

  .transparent-input-clr-blck {
    background: transparent;
    border: none;
    color: #222;
    margin: 0;
    text-align: left;
    font-family: var(--es-font);
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

  .padding-r-8 {
    padding-right: 8px;
  }

  .m-t-8 {
    margin-top: 8px;
  }

  .zero-pad-marg {
    margin: 0;
    padding: 0;
  }

  .row-gap {
    gap: 5px;
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
    margin: 0 !important;
  }

  .p-weight {
    font-weight: 700;
  }

  .margin-0 {
    margin: 0 !important;
  }

  .txt-lft {
    text-align: left !important;
  }

  .cmp-name {
    font-family: var(--es-font);
    font-size: var(--fs-md);
    font-weight: 700;
  }

  .subhead-earnings-label {
    text-align: left;
  }

  .deductions-table-inner {
    padding-left: 5px;
  }

  /* =====================================================
   EARNINGS / DEDUCTIONS TABLES
===================================================== */
  .es-middle {
    display: grid;
    grid-template-columns: 1fr 1fr;
    background: var(--es-bg);
    gap: 1px;
  }

  .es-subhead {
    display: grid;
    grid-template-columns: 1.6fr .9fr .9fr .9fr;
    background: var(--es-header-bg);
    color: white;
    font-family: var(--es-font);
    font-size: var(--fs-xs);
    font-weight: 700;
    padding: 7px 8px;
    letter-spacing: 0.4px;
    text-transform: uppercase;
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
    gap: 4px;
    align-items: center;
    padding: 3px 0;
  }

  .es-table-d .es-tr {
    grid-template-columns: 1.8fr 1fr 1fr;
  }

  .es-table-d {
    display: grid;
    grid-template-columns: 1.8fr 1fr 1fr;
    width: 100%;
    border-left: 1px solid var(--es-border);
  }

  .es-table-d .es-td input {
    width: 100%;
    border-bottom: 1px solid #e0e0e0;
    background-color: transparent;
    font-family: var(--es-font);
  }

  .es-table-d .es-tr {
    display: contents;
    border-bottom: 1px solid var(--es-border);
  }

  .es-table-d .hide-imp {
    display: none;
  }

  .es-td.es-lbl {
    font-family: var(--es-font);
    font-size: var(--fs-sm);
    font-weight: 600;
    margin: auto 0;
    color: #333;
    padding-left: 6px;
  }

  /* =====================================================
   FOOTER / TOTALS
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
   ACTIONS / BUTTONS
===================================================== */
  .es-actions {
    padding: 18px 0 12px;
    text-align: center;
    background: #fff;
  }

  .hide {
    padding-bottom: 20px;
    align-self: end;
  }

  .es-btn {
    border: 0;
    padding: 11px 32px;
    color: #fff;
    font-weight: 700;
    font-size: var(--fs-base);
    font-family: var(--es-font);
    border-radius: 5px;
    cursor: pointer;
    background: linear-gradient(180deg, var(--es-blue1), var(--es-blue2));
    letter-spacing: 0.5px;
    text-transform: uppercase;
    box-shadow: 0 3px 8px rgba(26, 134, 183, 0.35);
    transition: opacity 0.2s, transform 0.15s;
  }

  .es-btn:hover {
    opacity: 0.92;
    transform: translateY(-1px);
  }

  .es-note {
    margin-top: 8px;
    font-size: var(--fs-xs);
    color: #888;
    font-family: var(--es-font);
  }

  [label="responsive"] {
    display: none;
  }

  /* =====================================================
   CARD PADDING HELPER
===================================================== */
  .card-padding {
    padding: 20px;
  }

  /* =====================================================
   DEPOSIT SLIP
===================================================== */
  .deposit-slip {
    width: 100%;
    max-width: 100%;
    margin: 28px 0 40px;
    background: #f8f9fa;
    border: 1px solid #d9d9d9;
    border-radius: 6px;
    padding: 16px;
    font-family: var(--es-font);
    color: #222;
    box-sizing: border-box;
  }

  .stub-deposit-column {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .ds-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 14px;
  }

  .ds-company {
    font-size: var(--fs-md);
    font-weight: 800;
    margin-bottom: 4px;
    font-family: var(--es-font);
  }

  .ds-company-sub {
    font-size: var(--fs-sm);
    color: #555;
    font-family: var(--es-font);
  }

  .ds-right {
    min-width: 240px;
    text-align: right;
  }

  .ds-meta-row {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
    margin-bottom: 6px;
  }

  .ds-meta-label {
    font-size: var(--fs-sm);
    font-weight: 700;
    color: #333;
    font-family: var(--es-font);
  }

  .ds-meta-value {
    min-width: 110px;
    text-align: center;
    background: #fff;
    border: 1px solid #d0d0d0;
    padding: 5px 8px;
    font-size: var(--fs-sm);
    border-radius: 3px;
    font-family: var(--es-font);
  }

  .ds-mid {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 10px 0 12px;
  }

  .ds-pay-label {
    font-size: var(--fs-sm);
    font-weight: 700;
    color: #333;
    min-width: 34px;
    font-family: var(--es-font);
  }

  .ds-amount-words {
    flex: 1;
    background: #fff;
    border: 1px solid #d0d0d0;
    padding: 9px 12px;
    font-size: var(--fs-base);
    font-weight: 600;
    border-radius: 3px;
    line-height: 1.2;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-family: var(--es-font);
  }

  .ds-amount-box {
    min-width: 130px;
    text-align: center;
    background: #fff;
    border: 1px solid #d0d0d0;
    padding: 9px 10px;
    font-size: var(--fs-lg);
    font-weight: 700;
    border-radius: 3px;
    font-family: var(--es-font);
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
    font-size: var(--fs-xs);
    font-weight: 700;
    margin-bottom: 5px;
    color: #333;
    font-family: var(--es-font);
  }

  .ds-payee-box {
    display: inline-block;
    min-width: 200px;
    background: #fff;
    border: 1px solid #d0d0d0;
    padding: 7px 10px;
    border-radius: 3px;
    font-size: var(--fs-md);
    font-weight: 700;
    font-family: var(--es-font);
  }

  .ds-badge {
    text-align: right;
    min-width: 220px;
  }

  .ds-badge-title {
    font-size: var(--fs-md);
    font-weight: 900;
    letter-spacing: 0.5px;
    font-family: var(--es-font);
  }

  .ds-badge-sub {
    font-size: var(--fs-xs);
    font-weight: 700;
    color: #333;
    margin-top: 2px;
    font-family: var(--es-font);
  }

  .ds-footer {
    text-align: center;
    font-size: var(--fs-xs);
    font-weight: 700;
    color: #555;
    margin-top: 12px;
    letter-spacing: 0.5px;
    font-family: var(--es-font);
  }

  /* =====================================================
   RESPONSIVE — ≤ 1000px
===================================================== */
  @media (max-width: 1000px) {
    :root {
      --fs-xs: 9px;
      --fs-sm: 10px;
      --fs-base: 12px;
      --fs-md: 13px;
      --fs-lg: 14px;
    }

    .es-in,
    .es-in-sm,
    .es-in-md,
    .es-cell select {
      padding: 5px 3px;
    }

    .card-padding {
      padding: 14px;
    }
  }

  /* =====================================================
   RESPONSIVE — ≤ 880px  (side-by-side → stacked)
===================================================== */
  @media (max-width: 880px) {
    .flexer-1 {
      flex-direction: column;
      gap: 24px;
    }

    /* Step-1 panel: switch to 2-col grid */
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
      width: 240px;
    }

    .es-row.es-4,
    .es-row.es-payrow {
      grid-template-columns: 1fr 1fr;
    }

    .es-row.es-6 {
      grid-template-columns: 1fr 1fr 1fr;
    }

    .es-middle {
      grid-template-columns: 1fr !important;
    }
  }

  /* =====================================================
   RESPONSIVE — ≤ 650px
===================================================== */
  @media (max-width: 650px) {
    :root {
      --fs-xs: 9px;
      --fs-sm: 10px;
      --fs-base: 11px;
      --fs-md: 12px;
      --fs-lg: 13px;
    }

    .es-card {
      padding: 8px;
    }

    .card-padding {
      padding: 10px;
    }

    .es-title {
      font-size: 11px;
      letter-spacing: 0.5px;
    }

    .es-in,
    .es-in-sm,
    .es-in-md,
    .es-cell select {
      padding: 4px 2px;
    }

    .es-subhead {
      padding: 5px 4px;
    }

    .es-h {
      padding: 4px 0;
    }

    .es-btn {
      padding: 9px 20px;
    }

    .es-row.es-6 {
      grid-template-columns: 1fr 1fr;
    }

    /* Deposit slip at 650px */
    .ds-badge {
      min-width: 55%;
    }

    .ds-payee {
      width: 40%;
    }

    .ds-pay-label {
      width: 5%;
    }

    .ds-amount-words {
      width: 65%;
    }

    .ds-amount-box {
      min-width: 28%;
    }

    .ds-payee-box {
      min-width: 100%;
    }
  }

  /* =====================================================
   RESPONSIVE — ≤ 640px  (footer totals stacked)
===================================================== */
  @media (max-width: 640px) {
    .es-bottom {
      grid-template-columns: 1fr;
    }

    .es-gross,
    .es-totalded,
    .es-net {
      grid-column: 1 / -1;
      display: grid;
      grid-template-columns: auto 1fr;
      align-items: center;
      gap: 8px;
      border-right: 0;
    }

    .es-gross .es-h2,
    .es-totalded .es-h2,
    .es-net .es-h2 {
      grid-column: 1 / 2;
      white-space: nowrap;
    }

    .es-gross .es-inline,
    .es-totalded .es-inline,
    .es-net .es-inline {
      grid-column: 2 / 3;
      justify-content: flex-end;
    }

    .es-in-md {
      max-width: 100%;
      width: 80px;
    }

    .h2-label {
      background-color: transparent;
      border: 0;
      text-align: center;
    }

    [label="responsive"] {
      display: revert;
    }
  }

  /* =====================================================
   RESPONSIVE — ≤ 480px  (extra small)
===================================================== */
  @media (max-width: 480px) {

    .es-row.es-4,
    .es-row.es-payrow {
      grid-template-columns: 1fr 1fr;
    }

    .es-row.es-6 {
      grid-template-columns: 1fr 1fr;
    }

    .es-ribbon {
      flex-direction: column;
      gap: 6px;
    }

    .es-title {
      margin-left: 0;
      text-align: left;
      width: auto;
    }

    /* Deposit slip extra-small */
    .ds-top {
      flex-direction: column;
      gap: 8px;
    }

    .ds-right {
      min-width: unset;
      text-align: left;
    }

    .ds-meta-row {
      justify-content: flex-start;
    }

    .ds-badge {
      text-align: left;
      min-width: unset;
    }

    .ds-bottom {
      flex-direction: column;
      align-items: stretch;
      gap: 8px;
    }

    .ds-payee {
      width: 100%;
    }
  }
</style>