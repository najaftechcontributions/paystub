<?php
function r2(float $v): float
{
    return (float) number_format($v, 2, ".", "");
}
function m1(float $v): string
{
    return number_format($v, 2, ".", "");
}
function nc(float $v): float
{
    return $v > 0 ? $v : 0.0;
}
function pd(string $s): ?DateTime
{
    $s = trim($s);
    if ($s === "") {
        return null;
    }
    if (preg_match('~^\d{1,2}/\d{1,2}/\d{4}$~', $s)) {
        $dt = DateTime::createFromFormat("m/d/Y", $s);
        return $dt ?: null;
    }
    if (preg_match('~^\d{4}-\d{2}-\d{2}$~', $s)) {
        $dt = DateTime::createFromFormat("Y-m-d", $s);
        return $dt ?: null;
    }
    try {
        return new DateTime($s);
    } catch (Exception $e) {
        return null;
    }
}
function gw(string $d): int
{
    $t = pd($d);
    if (!$t) {
        return 1;
    }
    $t->setTime(0, 0, 0);
    $y = (int) $t->format("w");
    if ($y === 0) {
        $y = 7;
    }
    $t->modify(4 - $y . " days");
    $z = (int) $t->format("Y");
    $s = new DateTime($z . "-01-01");
    $s->setTime(0, 0, 0);
    $f = ((int) $t->format("U") - (int) $s->format("U")) / 86400;
    return max(1, (int) ceil(($f + 1) / 7));
}
function cy(int $m, string $d): int
{
    $t = pd($d);
    if (!$t) {
        return 1;
    }
    $n = (int) $t->format("n");
    if ($m === 52) {
        return gw($d);
    }
    if ($m === 26) {
        return (int) floor(gw($d) / 2);
    }
    if ($m === 12) {
        return $n;
    }
    if ($m === 6) {
        return (int) floor($n / 2);
    }
    return max(1, $m);
}
function pk(int $m): string
{
    return $m === 52
        ? "weekly"
        : ($m === 26
            ? "biweekly"
            : ($m === 12
                ? "monthly"
                : ($m === 6
                    ? "semimonthly"
                    : "weekly")));
}
function lt(string $p): array
{
    static $c = null;
    if ($c !== null) {
        return $c;
    }
    if (!is_file($p)) {
        throw new RuntimeException("");
    }
    $r = file_get_contents($p);
    $d = json_decode($r, true);
    if (!is_array($d) || !isset($d["federal"], $d["stateTaxes"])) {
        throw new RuntimeException("");
    }
    return $c = $d;
}
function sr(array $t, int $v): float
{
    return isset($t["stateTaxes"][$v]) ? (float) $t["stateTaxes"][$v] : 0.0;
}
function fb(array $t, int $m, string $ms, int $ex, float $g): array
{
    $d = ["subtract" => 160.0, "rate" => 0.1];
    $ms = strtolower(trim($ms));
    $k = pk($m);
    if (!isset($t["federal"][$k][$ms])) {
        return $d;
    }
    $a = $t["federal"][$k][$ms];
    if (!isset($a[$ex]) || !is_array($a[$ex])) {
        return $d;
    }
    $l = $a[$ex];
    $h = array_keys($l);
    usort($h, fn($x, $y) => (float) $x <=> (float) $y);
    $u = $d;
    foreach ($h as $v) {
        if (!($g > (float) $v)) {
            return $u;
        }
        $u = $l[$v];
    }
    return $u;
}
function cc(array $t, int $s, int $m, float $g): array
{
    $o = ["sdi" => 0.0, "sui" => 0.0, "fli" => 0.0, "wrk" => 0.0];
    if (!isset($t["sdi_settings"]["states"][(string) $s]["components"])) {
        return $o;
    }
    $cfg = $t["sdi_settings"]["states"][(string) $s]["components"];
    $a = $m === 1 ? $g : $g * $m;
    foreach ($cfg as $n => $c) {
        $y = $c["type"] ?? "";
        $r = (float) ($c["rate"] ?? 0.0);
        if ($y === "percent_cap_per_period") {
            $v = r2($g * $r);
            $p = isset($c["cap_by_pay_mode"][(string) $m])
                ? (float) $c["cap_by_pay_mode"][(string) $m]
                : null;
            if ($p !== null && $v > $p) {
                $v = r2($p);
            }
            $o[$n] = $v;
            continue;
        }
        if ($y === "percent_annual_cap") {
            $mi = (float) ($c["max_income"] ?? 0.0);
            $cb = $c["cap_by_pay_mode"] ?? [];
            $p = isset($cb[(string) $m]) ? (float) $cb[(string) $m] : null;
            if ($mi > 0 && $p !== null) {
                if ($a < $mi) {
                    $o[$n] = r2($g * $r);
                } else {
                    if (
                        $s === 5 &&
                        $m === 6 &&
                        isset($c["cap_condition_multiplier_for_6"])
                    ) {
                        $x = (float) $c["cap_condition_multiplier_for_6"];
                        $o[$n] = $g * $x >= $mi ? r2($p) : r2($g * $r);
                    } else {
                        $o[$n] = r2($p);
                    }
                }
            } else {
                $o[$n] = r2($g * $r);
            }
            continue;
        }
        if ($y === "percent_or_fixed_cap") {
            $mi = (float) ($c["max_income"] ?? 0.0);
            $fc = $c["fixed_cap_by_pay_mode"] ?? [];
            $p = isset($fc[(string) $m]) ? (float) $fc[(string) $m] : null;
            if ($mi > 0 && $p !== null) {
                $o[$n] = $a < $mi ? r2($g * $r) : r2($p);
            } else {
                $o[$n] = r2($g * $r);
            }
            continue;
        }
        if ($y === "percent_annual_cap_derived") {
            $mi = (float) ($c["max_income"] ?? 0.0);
            if ($mi <= 0) {
                $o[$n] = r2($g * $r);
            } else {
                if ($a < $mi) {
                    $o[$n] = r2($g * $r);
                } else {
                    $b = $m === 1 ? $mi : $mi / $m;
                    $o[$n] = r2($b * $r);
                }
            }
            continue;
        }
        $o[$n] = r2($g * $r);
    }
    return $o;
}
function ay(array $t, int $s, array $y): array
{
    if (!isset($t["sdi_settings"]["states"][(string) $s]["ytd_caps"])) {
        return $y;
    }
    $p = $t["sdi_settings"]["states"][(string) $s]["ytd_caps"];
    foreach (["sdi", "sui", "fli", "wrk"] as $k) {
        if (isset($p[$k])) {
            $y[$k] = r2(min((float) $y[$k], (float) $p[$k]));
        } else {
            $y[$k] = r2((float) $y[$k]);
        }
    }
    return $y;
}
function cp(array $i, array $t): array
{
    $s = (int) ($i["state"] ?? 0);
    $m = (int) ($i["pay_mode"] ?? 52);
    $y = strtolower(trim((string) ($i["pay_type"] ?? "hourly")));
    $r = (float) ($i["rate"] ?? 0);
    $h = (float) ($i["hours"] ?? 0);
    $ms = (string) ($i["marital_status"] ?? "single");
    $ex = (int) ($i["exemptions"] ?? 0);
    $is = (int) ($i["include_sdi"] ?? 0);
    $pd = (string) ($i["pay_date"] ?? date("m/d/Y"));
    $ey = trim((string) ($i["emp_ytd"] ?? ""));

    // ✅ NEW: read employment type
    $empStatusRaw = (string) ($i["emp_status"] ?? "Employee");
    $isContractor = (strcasecmp(trim($empStatusRaw), "Contractor") === 0);

    $g = $y === "hourly" ? r2($r * $h) : r2($r);

    // determine YTD period factor
    $f = 0;
    if ($ey !== "" && is_numeric($ey)) {
        $f = (int) $ey;
    }
    if ($f <= 0) {
        $f = cy($m, $pd);
    }
    if ($f <= 0) {
        $f = 1;
    }

    $gy = r2($g * $f);

    // ✅ NEW: contractor override (all deductions/taxes zero)
    if ($isContractor) {
        // force SDI off for contractors
        $is = 0;

        $fm = $fs = $ft = $tx = 0.0;
        $sd = $su = $fl = $wk = 0.0;

        $dd = 0.0;
        $np = $g;

        $fmy = $fsy = $fty = $sty = 0.0;

        $yc = [
            "sdi" => 0.0,
            "sui" => 0.0,
            "fli" => 0.0,
            "wrk" => 0.0,
        ];

        $dy = 0.0;
        $ny = $gy;

        return [
            "current" => [
                "total" => m1($g),
                "fica_medicare_total" => m1($fm),
                "fica_ss_total" => m1($fs),
                "federal_tax_total" => m1($ft),
                "state_tax_total" => m1($tx),
                "sdi_total" => m1($sd),
                "sui_total" => m1($su),
                "fli_total" => m1($fl),
                "wrk_total" => m1($wk),
                "deductions" => m1($dd),
                "net_pay" => m1($np),
            ],
            "ytd" => [
                "ytd_gross" => m1($gy),
                "fica_medicare_ytd_total" => m1($fmy),
                "fica_ss_ytd_total" => m1($fsy),
                "federal_tax_ytd_total" => m1($fty),
                "state_tax_ytd_total" => m1($sty),
                "sdi_ytd_total" => m1((float) $yc["sdi"]),
                "sui_ytd_total" => m1((float) $yc["sui"]),
                "fli_ytd_total" => m1((float) $yc["fli"]),
                "wrk_ytd_total" => m1((float) $yc["wrk"]),
                "ytd_deductions" => m1($dy),
                "ytd_net_pay" => m1($ny),
            ],
        ];
    }

    // ===== Existing Employee logic (unchanged) =====
    $ka = $t["fica_settings"] ?? [];
    $mr = (float) ($ka["medicare_rate"] ?? 0.0145);
    $sr = (float) ($ka["social_security_rate"] ?? 0.062);
    $sb = (float) ($ka["social_security_wage_base"] ?? 142800.0);

    $fm = r2($mr * $g);
    $fs = $gy <= $sb ? r2($sr * $g) : r2($sr * ($sb / $f));

    $st = sr($t, $s);
    $tx = r2($g * $st);

    $bk = fb($t, $m, $ms, $ex, $g);
    $sub = (float) ($bk["subtract"] ?? 160.0);
    $fr = (float) ($bk["rate"] ?? 0.1);
    $ft = r2(nc(($g - $sub) * $fr));

    $cm = ["sdi" => 0.0, "sui" => 0.0, "fli" => 0.0, "wrk" => 0.0];
    if ($is === 1) {
        $cm = cc($t, $s, $m, $g);
    }

    $sd = (float) $cm["sdi"];
    $su = (float) $cm["sui"];
    $fl = (float) $cm["fli"];
    $wk = (float) $cm["wrk"];

    $dd = r2($fm + $fs + $ft + $tx + ($is ? $sd + $su + $fl + $wk : 0));
    $np = r2($g - $dd);

    $fmy = r2($fm * $f);
    $fsy = r2($fs * $f);
    $fty = r2($ft * $f);
    $sty = r2($tx * $f);

    $yc = [
        "sdi" => r2($sd * $f),
        "sui" => r2($su * $f),
        "fli" => r2($fl * $f),
        "wrk" => r2($wk * $f),
    ];
    $yc = ay($t, $s, $yc);

    $dy = r2($dd * $f);
    $ny = r2($np * $f);

    return [
        "current" => [
            "total" => m1($g),
            "fica_medicare_total" => m1($fm),
            "fica_ss_total" => m1($fs),
            "federal_tax_total" => m1($ft),
            "state_tax_total" => m1($tx),
            "sdi_total" => m1($sd),
            "sui_total" => m1($su),
            "fli_total" => m1($fl),
            "wrk_total" => m1($wk),
            "deductions" => m1($dd),
            "net_pay" => m1($np),
        ],
        "ytd" => [
            "ytd_gross" => m1($gy),
            "fica_medicare_ytd_total" => m1($fmy),
            "fica_ss_ytd_total" => m1($fsy),
            "federal_tax_ytd_total" => m1($fty),
            "state_tax_ytd_total" => m1($sty),
            "sdi_ytd_total" => m1((float) $yc["sdi"]),
            "sui_ytd_total" => m1((float) $yc["sui"]),
            "fli_ytd_total" => m1((float) $yc["fli"]),
            "wrk_ytd_total" => m1((float) $yc["wrk"]),
            "ytd_deductions" => m1($dy),
            "ytd_net_pay" => m1($ny),
        ],
    ];
}
