<?php
// APP/pypl/ajax.php

require_once __DIR__ . '/functions.php';


function paypal_create_order_server($totals, $title, $desc) {
    $accessToken = paypal_get_access_token();
    if (!$accessToken) {
        return ['error' => 'Unable to get PayPal access token'];
    }

    $currency   = "USD";
    $grandValue = number_format($totals['grand'], 2, '.', '');

    $payload = [
        "intent" => "CAPTURE",
        "purchase_units" => [[
            "description" => $desc,
            "amount" => [
                "currency_code" => $currency,
                "value" => $grandValue,
                // Optional: itemization can be added later; keep minimal for now
            ],
        ]]
    ];

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => sandbox_filter("https://api-m.sandbox.paypal.com/v2/checkout/orders"),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "Authorization: Bearer $accessToken"
        ],
        CURLOPT_POSTFIELDS => json_encode($payload),
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if (empty($data['id'])) {
        return ['error' => 'PayPal order create failed', 'paypal' => $data];
    }

    return ['orderID' => $data['id']];
}

add_action('wp_ajax_nopriv_paystub_create_order', 'paystub_ajax_create_order');
add_action('wp_ajax_paystub_create_order', 'paystub_ajax_create_order');

function paystub_ajax_create_order() {
    $paystubs     = intval($_POST['paystubs'] ?? 1);
    $depositSlip  = (!empty($_POST['depositSlip']) && $_POST['depositSlip'] === '1');

    // Load title/desc from your config.json (same source you already use)
    $config_path = __DIR__ . '/../../Admin/pypl/config.json';
    $cfg = json_decode(@file_get_contents($config_path), true) ?: [];

    $title = $cfg['product_title'] ?? 'Paystub';
    $desc  = $cfg['product_desc'] ?? 'Paystub purchase';

    // Authoritative totals
    $totals = paystub_compute_totals($paystubs, $depositSlip);

    // Create order in PayPal from server
    $created = paypal_create_order_server($totals, $title, $desc);

    if (!empty($created['error'])) {
        wp_send_json_error($created, 500);
    }

    // Store expected total for verification step
    set_transient('paystub_expected_' . $created['orderID'], $totals, 10 * MINUTE_IN_SECONDS);

    wp_send_json_success([
        'orderID' => $created['orderID'],
        'totals'  => $totals
    ]);
}

add_action('wp_ajax_nopriv_paystub_verify_capture', 'paystub_ajax_verify_capture');
add_action('wp_ajax_paystub_verify_capture', 'paystub_ajax_verify_capture');

function paystub_ajax_verify_capture() {
    $captureId = sanitize_text_field($_POST['captureId'] ?? '');
    $orderId   = sanitize_text_field($_POST['orderId'] ?? '');

    if (!$captureId || !$orderId) {
        wp_send_json_error(['message' => 'Missing captureId/orderId'], 400);
    }

    $expected = get_transient('paystub_expected_' . $orderId);
    if (!$expected) {
        wp_send_json_error(['message' => 'No expected total found (expired?)'], 400);
    }

    $cap = verify_paypal_capture($captureId);

    $status = $cap['status'] ?? '';
    $value  = $cap['amount']['value'] ?? null;
    $cents  = (int) round(floatval($value) * 100);

    if ($status !== 'COMPLETED') {
        wp_send_json_error(['message' => 'Capture not completed', 'paypal' => $cap], 400);
    }

    if ($cents !== (int)$expected['grand_cents']) {
        wp_send_json_error([
            'message' => 'Paid amount mismatch',
            'expected_cents' => $expected['grand_cents'],
            'got_cents' => $cents,
        ], 400);
    }

    wp_send_json_success(['ok' => true]);
}
