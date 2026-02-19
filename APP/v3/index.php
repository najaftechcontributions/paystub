<?php
function FS($s)
{
    $r = preg_replace("/[^0-9.]/", "", $s);
    return floatval($r);
}
$pt = strtolower($_POST["pay_type"] ?? "hourly");
$m = [
    "Weekly" => 52,
    "Bi-Weekly" => 26,
    "Monthly" => 12,
    "Bi-Monthly" => 6,
    "Annually" => 1,
];
$rt = $_POST["gross_pay_total"];
$pl = [
    "state" => FS($_POST["state"] ?? 1),
    "pay_type" => $pt,
    "pay_mode" => $m[$_POST["pay_mode"] ?? "Weekly"],
    "rate" => $rt,
    "hours" => 1,
    "marital_status" => $_POST["marital_status"],
    "exemptions" => FS($_POST["exemptions"]),
    "include_sdi" => FS($_POST["include_sdi"]),
    "emp_ytd" => FS($_POST["emp_ytd"]),
    "pay_date" => $_POST["pay_date"],

    // ✅ add this line
    "emp_status" => $_POST["emp_status"] ?? "Employee",
];

include __DIR__ . "/c.php";
try {
    // $t = lt(__DIR__ . "/tax_tables_v1.json");
    $t = lt(__DIR__ . "/../Admin/tax_tables.json");
    echo json_encode(["ok" => true, "result" => cp($pl, $t)]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(["ok" => false, "error" => $e->getMessage()]);
}
