function isAutoCalcEnabled() {
  return $('[name="auto-calc"]').val() === "on";
}

function getVar(e) {
  return new URLSearchParams(window.location.search).get(e);
}
function enable_SDI(e = 1) {
  ("1" == e && $('[sdi-field="1"]').show(),
    "0" == e &&
      ($('[sdi-field="1"]').hide(),
      $('[cname="include_sdi"]').removeClass("checked"),
      $('[name="include_sdi"]').val(0)));
}
function SDI_check() {
  var e = parseFloat($('[name="state"]').val());
  [40, 12, 5, 31, 33].includes(e) ? enable_SDI(1) : enable_SDI(0);
}
function formatDate(e, t = !1) {
  return `${t ? String(e.getMonth() + 1).padStart(2, "0") : e.getMonth() + 1}/${t ? String(e.getDate()).padStart(2, "0") : e.getDate()}/${e.getFullYear()}`;
}
function calculatePayPeriod(payMode, payDate = new Date()) {
  const pay = parsePayDate(payDate) || new Date();
  pay.setHours(12, 0, 0, 0);

  // Read Week-In-Hole value
  const weekInHole = $('[name="week-in-hole"]').val() === "On";
  const arrearsDays = 7;

  let periodEnd = new Date(pay);
  let periodStart = new Date(pay);

  // ===== PERIOD LENGTH =====
  let periodLength = 0;

  switch (payMode) {
    case "Weekly":
      periodLength = 7;
      break;
    case "Bi-Weekly":
      periodLength = 14;
      break;
    case "Monthly":
      periodLength = 30; // existing approximation (unchanged)
      break;
    case "Bi-Monthly":
      periodLength = 61; // existing approximation (unchanged)
      break;
    case "Annually":
      periodStart.setFullYear(pay.getFullYear() - 1);
      return [formatDate(periodStart), formatDate(pay), formatDate(pay, true)];
  }

  // ===== WEEK-IN-HOLE LOGIC =====
  if (weekInHole) {
    // Shift WORK PERIOD only
    periodEnd.setDate(pay.getDate() - arrearsDays);
  } else {
    // Existing behavior (period ends day before pay date)
    periodEnd.setDate(pay.getDate() - 1);
  }

  // Start date = end date - (periodLength - 1)
  periodStart = new Date(periodEnd);
  periodStart.setDate(periodEnd.getDate() - (periodLength - 1));

  return [
    formatDate(periodStart),
    formatDate(periodEnd),
    formatDate(pay, true),
  ];
}

function GET_INITIALS(e) {
  if (!e || "string" != typeof e) return "";
  if (!(e = e.trim())) return "";
  const t = e.split(/\s+/);
  return (
    t[0].charAt(0) +
    (t.length > 1 ? t[t.length - 1].charAt(0) : t[0].charAt(t[0].length - 1))
  ).toUpperCase();
}
function update_framer(e) {
  window.parent &&
    "function" == typeof window.parent.happs_iframe_dynamic_resizer &&
    window.parent.happs_iframe_dynamic_resizer(e);
}
function parsePayDate(e) {
  if (!e) return null;
  if (e instanceof Date && !isNaN(e)) return new Date(e.getTime());
  const t = String(e).trim();
  let a = t.match(/^(\d{4})-(\d{1,2})-(\d{1,2})$/);
  if (a) return new Date(Number(a[1]), Number(a[2]) - 1, Number(a[3]));
  if (((a = t.match(/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/)), a))
    return new Date(Number(a[3]), Number(a[1]) - 1, Number(a[2]));
  const n = new Date(t);
  return isNaN(n) ? null : n;
}
function getWeekNumber(e) {
  const t = parsePayDate(e);
  if (!t) return 1;
  t.setHours(0, 0, 0, 0);
  let a = t.getDay();
  (0 === a && (a = 7), t.setDate(t.getDate() + (4 - a)));
  const n = t.getFullYear(),
    i = new Date(n, 0, 1);
  i.setHours(0, 0, 0, 0);
  const s = (t.getTime() - i.getTime()) / 864e5,
    o = Math.ceil((s + 1) / 7);
  return Math.max(1, o);
}
function curYTD(e = "", t = "") {
  if ("" == e && "" == t)
    ((t = $('[date-field="pay_date"]').val()),
      (e = $('[name="pay_mode"]').val()));
  const a = parsePayDate(t);
  if (!a) return 1;
  var n = {
    Weekly: 52,
    "Bi-Weekly": 26,
    Monthly: 12,
    "Bi-Monthly": 6,
    Annually: 1,
  }[e];
  const i = a.getMonth() + 1,
    s = parseInt(n, 10) || 0;
  return 52 === s
    ? getWeekNumber(t)
    : 26 === s
      ? Math.floor(getWeekNumber(t) / 2)
      : 12 === s
        ? i
        : 6 === s
          ? Math.floor(i / 2)
          : Math.max(1, s);
}
function FSYM(e) {
  var t = parseFloat(e);
  return isNaN(t) ? 0 : t;
}
function calc_pay_totals(e = 1) {
  var t = 0,
    a = 0;
  ($('[addon_paystub="' + e + '"] [table="pay_table"] div.es-tr').each(
    function (n, i) {
      var s = FSYM($(this).find("input").eq(0).val()),
        o = FSYM($(this).find("input").eq(1).val()),
        d = $('[name="emp_ytd"]').val(),
        r = $('[addon_paystub="' + e + '"]')
          .find('[date-field="pay_date"]')
          .val(),
        c = curYTD(
          $('[addon_paystub="' + e + '"]')
            .find('[name="pay_mode"]')
            .val(),
          r,
        );
      if ("0" == d) var l = c;
      else l = d;
      l = FSYM(l);
      var p = $(this).find("input").eq(2),
        u = $(this).find("input").eq(3),
        _ = s * o;
      p.val(_);
      var f = _ * l;
      (u.val(f), (t += f), (a += _));
    },
  ),
    $('[addon_paystub="' + e + '"] [result="gross_pay_total"]').val(a),
    $('[addon_paystub="' + e + '"] [result="gross_pay_ytd"]').val(t));
}
function re_calc_pay_totals() {
  for (
    var e = parseFloat($('[name="no_of_paystub"]').val()), t = 1;
    t <= e;
    t++
  )
    calc_pay_totals(t);
}
function calc(e = "1") {
  var t =
    $(
      '#step-1 input, #step-1 select, [addon_paystub="' +
        e +
        '"] input, [addon_paystub="' +
        e +
        '"] select',
    ).serialize() +
    "&ps=" +
    e;
  (e > 1 && $('[addon_paystub="' + e + '"]').css("filter", "blur(2px)"),
    $.ajax({ url: "v3/", type: "POST", data: t, cache: !1 }).done(function (t) {
      $('[addon_paystub="' + e + '"]').css("filter", "");
      var a = (t = JSON.parse(t)).result.current;
      $.each(a, function (t, a) {
        "object" != typeof a &&
          $('[addon_paystub="' + e + '"] [result="' + t + '"]').val(a);
      });
      a = t.result.ytd;
      $.each(a, function (t, a) {
        "object" != typeof a &&
          $('[addon_paystub="' + e + '"] [result="' + t + '"]').val(a);
      });
    }));
}
($(document).on("change", '[name="state"]', function () {
  SDI_check();
}),
  $(document).on("click", '[cname="include_sdi"],[sdi-label="1"]', function () {
    var e = $('[cname="include_sdi"]');
    ($(e).hasClass("checked")
      ? ($(e).removeClass("checked"),
        $('[name="include_sdi"]').val(0),
        $('[custom-row="SDI"]').addClass("hide-imp"))
      : ($(e).addClass("checked"),
        $('[name="include_sdi"]').val(1),
        $('[custom-row="SDI"]').removeClass("hide-imp")),
      $('[name="include_sdi"]').trigger("change"));
  }),
  $(document).on(
    "change",
    '[addon_paystub="1"] [name="pay_mode"], [addon_paystub="1"][date-field="pay_date"]',
    function () {
      var e = calculatePayPeriod(
        $('[addon_paystub="1"] [name="pay_mode"]').val(),
        $('[addon_paystub="1"] [date-field="pay_date"]').val(),
      );
      ($('[addon_paystub="1"] [date-field="pay_period_start"]').val(e[0]),
        $('[addon_paystub="1"] [date-field="pay_period_end"]').val(e[1]),
        set_def_dates_for_additional_stubs());
    },
  ),
  $(document).ready(function () {
    $('[addon_paystub="1"] [name="pay_mode"]').trigger("change");
  }),
  $(document).on("change", '[name="state"]', function () {
    var e = parseFloat($('[name="state"]').val()),
      t = GET_INITIALS($('[name="state"] option:selected').text());
    "31" == e
      ? ($('[custom-label="sdi"]').text("NJ SDI"),
        $('[custom-row="NJ"]').removeClass("hide-imp"),
        update_framer(1))
      : ($('[custom-label="sdi"]').text(t + " TDI"),
        $('[custom-row="NJ"]').addClass("hide-imp"),
        update_framer(0));
  }),
  getVar("enable_addon") && "1" == getVar("enable_addon")
    ? ($('[addon-rows="income"]').css("display", "grid"),
      $('[name="enable_additional_rows"]').val(1))
    : ($('[addon-rows="income"]').css("display", "none"),
      $('[name="enable_additional_rows"]').val(0)));
var effective_inputs = '[table="pay_table"] input';
function show_preview() {
  var e = $(".es-wrap input,.es-wrap select"),
    t = $(".es-bottom input"),
    a = $('[addon_paystub="1"] [field="check_no"]'),
    n = a.val();
  ((n = n.replaceAll("#", "")),
    a.val("#" + n),
    e.css({
      border: "0px solid #cfcfcf",
      "background-color": "transparent",
    }),
    $(".cmp-name").css({ "font-weight": "700" }),
    $("select,input").css({ "border": "none !important" }),
    $(".es-subhead").css({ "text-align": "center" }),
    $(".es-wrap [date-field]").css({ "max-width": "80px" }),
    $('[table="pay_table"] input, [table="deduction"] input').css(
      "text-align",
      "center",
    ),
    $('input[name="ssn"]').css("padding-left", "0px"),
    t.css({ "font-weight": "600" }),
    $(".es-wrap input").prop("readonly", !0),
    $(".es-wrap select").css({
      "pointer-events": "none",
      "background-color": "transparent",
      "-webkit-appearance": "none",
      appearance: "none",
    }),
    $("#step-1").hide(),
    $(".flexer-1").removeClass("flexer-1").addClass("flexer-1_"),
    "function" == typeof parent.pypl_btns_render &&
      parent.pypl_btns_render("show_btns"),
    $(".es-wrap").addClass("es-wrap-w"),
    $('[additiona-btn="preview"]').hide());
  // ✅ Deposit slip: only show in preview if checkbox is checked
  var showDeposit = $('[name="deposit-slip"]').is(":checked");
  var count = parseInt($('[name="no_of_paystub"]').val() || "1", 10) || 1;

  if (showDeposit) {
    for (let i = 1; i <= count; i++) {
      const $stub = $('[addon_paystub="' + i + '"]');
      $stub.find(".deposit-slip").show();
      fillDepositSlip($stub);
    }
  } else {
    $(".deposit-slip").hide();
  }

  emitCheckoutState();
}
function show_editable() {
  var e = $(".es-wrap input,.es-wrap select"),
    t = $(".es-bottom input"),
    a = $('[addon_paystub="1"] [field="check_no"]'),
    n = a.val();
  (a.val(n.replaceAll("#", "")),
    e.css({
      "background-color": "",
      "font-weight": "",
    }),
    t.css({ "font-weight": "" }),
    $(".es-wrap input").prop("readonly", !1),
    $(".es-wrap select").css({
      "pointer-events": "",
      "background-color": "",
      "-webkit-appearance": "",
      appearance: "",
    }),
    $(".ps-body select,.ps-body input").css({ "border": "1px solid #cfcfcf" }),
    $(".es-subhead").css({ "text-align": "" }),
    $(".es-wrap [date-field]").css({ "max-width": "" }),
    $('[table="pay_table"] input, [table="deduction"] input').css(
      "text-align",
      "",
    ),
    $('input[name="ssn"]').css("padding-left", ""),
    $("#step-1").show(),
    $(".flexer-1_").removeClass("flexer-1_").addClass("flexer-1"),
    "function" == typeof parent.pypl_btns_render &&
      parent.pypl_btns_render("hide_btns"),
    $(".es-wrap").removeClass("es-wrap-w"),
    parseFloat($('[name="no_of_paystub"]').val()) > 1
      ? $('[additiona-btn="preview"]').hide()
      : $('[additiona-btn="preview"]').hide());
      $(".deposit-slip").hide();
  emitCheckoutState();
}
function autofill() {
  for (
    var e = [
        '[field="check_no"] ## 892314',
        '[name="company_name"] ## Horizon Tech Solutions LLC',
        '[name="company_address"] ## 2458 Market Street, Suite 310, San Francisco, CA 94114',
        '[name="employee_name"] ## Michael Anderson',
        '[name="ssn"] ## 4829',
        '[name="employee_no"] ## EMP-1047',
        '[name="employee_address"] ## 7812 Oak Valley Drive, Austin, TX 78745',
      ],
      t = 0;
    t < e.length;
    t++
  ) {
    var a = e[t],
      n = a.split("##")[0],
      i = a.split("##")[1];
    $('[addon_paystub="1"] ' + n).val(i);
  }
}
function show_additional_paystubs() {
  var e = parseFloat($('[name="no_of_paystub"]').val());
  if (
    ($('[paystub-input],[addon-paystubs-box="1"] [addon_paystub]').hide(),
    $("[paystub-input] input").attr("required", !1),
    $('[additiona-btn="preview"]').hide(),
    e > 1)
  ) {
    for (var t = 2; t <= e; t++)
      ($(
        "[paystub-input=" +
          t +
          '], [addon-paystubs-box="1"] [addon_paystub="' +
          t +
          '"]',
      ).show(),
        $('[paystub-input="' + t + '"] input').attr("required", !0));
  }
}
function set_def_dates_for_additional_stubs() {
  for (
    var e = $('[name="pay_mode"]').val(),
      t = $('[date-field="pay_period_start"]').val(),
      a = 2;
    a <= 12;
    a++
  ) {
    var n = calculatePayPeriod(e, t);
    ($('[paystub-input="' + a + '"] [idate="pay_date"]').val(t),
      $('[paystub-input="' + a + '"] [idate="pay_start"]').val(n[0]),
      $('[paystub-input="' + a + '"] [idate="pay_end"]').val(n[1]),
      (t = n[0]));
  }
}
function copy_paystub_details(e, t = !0) {
  var a = $('[addon_paystub="1"]');
  (a.find("input:not(input[date-field])").each(function (e, t) {
    ($(this).attr("date-field"), $(this).attr("value", this.value));
  }),
    a.find("select").each(function () {
      const e = $(this).val();
      $(this)
        .find("option")
        .each(function () {
          $(this).val() == e
            ? $(this).attr("selected", "selected")
            : $(this).removeAttr("selected");
        });
    }));
  var n = a.html();
  ($('[addon-paystubs-box="1"] [paystub-content="' + e + '"]').each(
    function (e, t) {
      $(this).html(n);
      var a = $(this).attr("paystub-content"),
        i = $('[paystub-content="' + a + '"]'),
        s = $('[paystub-input="' + a + '"]')
          .find('[idate="pay_date"]')
          .val();
      (i.find('input[date-field="pay_date"]').val(s),
        (s = $('[paystub-input="' + a + '"]')
          .find('[idate="pay_start"]')
          .val()),
        i.find('input[date-field="pay_period_start"]').val(s),
        (s = $('[paystub-input="' + a + '"]')
          .find('[idate="pay_end"]')
          .val()),
        i.find('input[date-field="pay_period_end"]').val(s),
        (s = $('[paystub-input="' + a + '"]')
          .find('[i="check_no"]')
          .val()),
        i.find('input[field="check_no"]').val("#" + s),
        (s = $('[paystub-input="' + a + '"]')
          .find('[i="hours"]')
          .val()),
        i.find('input[pid="p18"]').val(s));
    },
  ),
    t && calc(e));
}
function re_calc_all_paystubs(e = !0) {
  for (
    var t = parseFloat($('[name="no_of_paystub"]').val()), a = 2;
    a <= t;
    a++
  )
    copy_paystub_details(a, e);
}
function generate_check_no() {}
function count_txt() {
  $('[animate="1"]').each(function () {
    var e = $(this);
    if ("-" != e.text() && !isNaN(FORMAT_SYM(e.text()))) {
      var t = $(this).text();
      jQuery({ Counter: 0 }).animate(
        { Counter: FORMAT_SYM(e.text()) },
        {
          duration: 500,
          easing: "swing",
          step: function () {
            e.text(INTX(this.Counter));
          },
          complete: function () {
            e.text(t);
          },
        },
      );
    }
  });
}
function do_preview() {
  (save_data("save"),
    $('[action-btn="preview"]').hide(),
    $('[action-btn="edit"]').show(),
    show_preview(),
    $(".es-card.card").addClass("wtmrk"),
    $('[addon-paystubs-box="1"]').css("display", "revert"),
    sendHeight());
}
function save_all_input_values() {
  ($("input").each(function (e, t) {
    $(this).attr("value", this.value);
  }),
    $("select").each(function () {
      const e = $(this).val();
      $(this)
        .find("option")
        .each(function () {
          $(this).val() == e
            ? $(this).attr("selected", "selected")
            : $(this).removeAttr("selected");
        });
    }));
}
function save_data(e = "save") {
  var t = "type=" + e + "&ref_id=" + ref_id;
  ("save" == e &&
    (save_all_input_values(),
    (t += "&data=" + encodeURIComponent($("#calc-main-content").html()))),
    $.ajax({ url: "save/", type: "POST", data: t, cache: !1 }).done(
      function (t) {
        ("function" == typeof parent.happs_ref_id_url &&
          "save" == e &&
          parent.happs_ref_id_url(ref_id),
          "retrive" == e &&
            "" !== t &&
            ($(".main-1").html(t), $('[name="state"]').trigger("change")));
      },
    ));
}
(((effective_inputs +=
  ', #step-1 input:not(input[name="email"]), #step-1 select'),
(effective_inputs += ', [addon_paystub="1"] input[name]'),
(effective_inputs += ', [addon_paystub="1"] select[name]'),
(effective_inputs += ", [paystub-input] input"),
$(document).on("change", effective_inputs, function () {
  if (!isAutoCalcEnabled()) return;

  calc();
  re_calc_all_paystubs();
  re_calc_pay_totals();
  generate_check_no();
}),
$(document).ready(function () {
  if (isAutoCalcEnabled()) {
    calc();
  }
}),
$(document).on("click", '[action="preview-stub"]', function () {
  (show_preview(),
    $('[action-btn="preview"]').hide(),
    $('[action-btn="edit"]').show());
}),
$(document).on("click", '[action="edit-stub"]', function () {
  ($('[addon-paystubs-box="1"]').css("display", "none"),
    $(".es-card.card").removeClass("wtmrk"),
    show_editable(),
    $('[action-btn="edit"]').hide(),
    $('[action-btn="preview"]').show(),
    (custom_height = 800));
}),
$(document).on("change", '[name="no_of_paystub"]', function () {
  show_additional_paystubs();
}),
$(document).ready(function () {
  show_additional_paystubs();
}),
$(document).ready(function () {
  save_data("retrive");
})),
  $(document).on("change", '[name="auto-calc"]', function () {
    if (isAutoCalcEnabled()) {
      calc();
      re_calc_all_paystubs();
      re_calc_pay_totals();
    }
    $(document).on("change", 'select[name="emp_status"]', function () {
      if (!isAutoCalcEnabled()) return;
      calc();
      re_calc_all_paystubs();
      re_calc_pay_totals();
    });
  }));
$(document).on(
  "change",
  '[name="no_of_paystub"], [name="deposit-slip"]',
  function () {
    emitCheckoutState();
  },
);

// Recalculate pay period when Week-In-Hole changes
$(document).on("change", '[name="week-in-hole"]', function () {
  $('[addon_paystub="1"] [name="pay_mode"]').trigger("change");
});

$(document).on("click", '[action="edit-stub"]', function () {
  $(".deposit-slip").hide();
});

// ====== EMPLOYEE/CONTRACTOR ADDRESS TOGGLE FUNCTIONALITY ======

// Function to update ALL employee references based on employment type
function updateAllEmployeeReferences() {
  var empType = $('select[name="emp_status"]').val();
  var isContractor = empType === "Contractor";

  // 1. Update checkbox label in 1.php
  var checkboxLabel = isContractor
    ? "ADD CONTRACTOR ADDRESS"
    : "ADD EMPLOYEE ADDRESS";
  $('.khyzer[name="email"]').next("span").text(checkboxLabel);

  // 2. Update field label in 2.php
  var fieldLabel = isContractor ? "CONTRACTOR ADDRESS" : "EMPLOYEE ADDRESS";
  $('[name="employee_address"]')
    .closest(".es-row")
    .find(".es-h")
    .text(fieldLabel);

  // 3. Update placeholder text
  var placeholder = isContractor ? "Contractor Address" : "Employee Address";
  $('[name="employee_address"]').attr("placeholder", placeholder);

  // 4. Update EMPLOYEE NAME field label
  var nameLabel = isContractor ? "CONTRACTOR NAME" : "EMPLOYEE NAME";
  $('[name="employee_name"]').closest(".es-cell").find(".es-h").text(nameLabel);
  $('[name="employee_name"]').attr(
    "placeholder",
    isContractor ? "Contractor Name" : "Employee Name",
  );

  // 5. Update EMPLOYEE NO. field label
  var empNoLabel = isContractor ? "CONTRACTOR NO." : "EMPLOYEE NO.";
  $('[name="employee_no"]').closest(".es-cell").find(".es-h").text(empNoLabel);

  // 6. Update document title if needed (optional - uncomment if needed)
  // $('.es-title').text(isContractor ? 'CONTRACTOR EARNINGS STATEMENT' : 'EARNINGS STATEMENT');
}

// Function to show/hide address field based on checkbox state
function toggleAddressField() {
  var isChecked = $('.khyzer[name="email"]').is(":checked");
  if (isChecked) {
    // Show address row when checkbox is checked
    $('[name="employee_address"]').closest(".es-row").show();
  } else {
    // Hide address row when checkbox is unchecked
    $('[name="employee_address"]').closest(".es-row").hide();
  }
}

// Initialize all functions on page load
$(document).ready(function () {
  // Set all employee/contractor references
  updateAllEmployeeReferences();

  // Set initial address field visibility
  toggleAddressField();
});

// Listen for checkbox changes
$(document).on("change", '.khyzer[name="email"]', function () {
  toggleAddressField();
});

// Listen for employment type changes
$(document).on("change", 'select[name="emp_status"]', function () {
  updateAllEmployeeReferences();
});

function fillDepositSlip($stub) {
  // scope slip within this stub
  const $slip = $stub.find(".deposit-slip");
  if (!$slip.length) return;

  // Read values from THIS stub
  const company = $stub.find('[name="company_name"]').val() || "";
  const checkNoRaw = ($stub.find('[field="check_no"]').val() || "")
    .replace(/#/g, "")
    .trim();
  const payDate = $stub.find('[date-field="pay_date"]').val() || "";
  const empName = $stub.find('[name="employee_name"]').val() || "";

  const net = parseFloat($stub.find('[result="net_pay"]').val() || 0).toFixed(
    2,
  );

  $slip.find('[data-ds="company_name"]').text(company);
  $slip.find('[data-ds="check_no"]').text(checkNoRaw ? `#${checkNoRaw}` : "#");
  $slip.find('[data-ds="pay_date"]').text(payDate);
  $slip.find('[data-ds="employee_name"]').text(empName);
  $slip.find('[data-ds="net_pay"]').text(`$${net}`);
  $slip.find('[data-ds="amount_words"]').text(moneyToWordsUSD(net));
}

function moneyToWordsUSD(amount) {
  amount = parseFloat(amount);
  if (isNaN(amount)) return "";

  const dollars = Math.floor(amount);
  const cents = Math.round((amount - dollars) * 100);

  const dollarWords = numberToWords(dollars);
  const centWords = numberToWords(cents);

  return `*${dollarWords} Dollar${dollars !== 1 ? "s" : ""}* *${centWords} Cent${cents !== 1 ? "s" : ""}*`;
}

// Simple helper for numbers → words (0–9999, can expand if needed)
function numberToWords(num) {
  const ones = [
    "Zero",
    "One",
    "Two",
    "Three",
    "Four",
    "Five",
    "Six",
    "Seven",
    "Eight",
    "Nine",
  ];
  const teens = [
    "Ten",
    "Eleven",
    "Twelve",
    "Thirteen",
    "Fourteen",
    "Fifteen",
    "Sixteen",
    "Seventeen",
    "Eighteen",
    "Nineteen",
  ];
  const tens = [
    "",
    "",
    "Twenty",
    "Thirty",
    "Forty",
    "Fifty",
    "Sixty",
    "Seventy",
    "Eighty",
    "Ninety",
  ];
  const thousands = ["", "Thousand"];

  if (num === 0) return "Zero";
  if (num < 10) return ones[num];
  if (num < 20) return teens[num - 10];
  if (num < 100)
    return (
      tens[Math.floor(num / 10)] + (num % 10 !== 0 ? " " + ones[num % 10] : "")
    );
  if (num < 1000)
    return (
      ones[Math.floor(num / 100)] +
      " Hundred" +
      (num % 100 !== 0 ? " " + numberToWords(num % 100) : "")
    );
  if (num < 10000)
    return (
      ones[Math.floor(num / 1000)] +
      " Thousand" +
      (num % 1000 !== 0 ? " " + numberToWords(num % 1000) : "")
    );

  return num.toString(); // fallback
}

function emitCheckoutState() {
  try {
    const state = {
      type: "CHECKOUT_STATE",
      preview: $("#step-1").is(":hidden"), // preview mode = step-1 hidden
      paystubs: parseInt($('[name="no_of_paystub"]').val() || "1", 10) || 1,
      depositSlip: $('[name="deposit-slip"]').is(":checked"),
    };

    window.parent && window.parent.postMessage(state, "*");
    console.log("Sent CHECKOUT_STATE:", state);
  } catch (e) {
    console.log("emitCheckoutState failed:", e);
  }
}
