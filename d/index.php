<?php

function download_pdf_to_browser(string $url, ?string $filename = null)
{
    if (!$url) {
        http_response_code(400);
        exit('Missing PDF URL');
    }

    // Auto filename
    if (!$filename) {
        $filename = basename(parse_url($url, PHP_URL_PATH)) ?: 'document_' . time() . '.pdf';
    }

    if (strtolower(substr($filename, -4)) !== '.pdf') {
        $filename .= '.pdf';
    }

    // Clean output buffer
    if (ob_get_length()) {
        ob_end_clean();
    }

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT        => 60,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
    ]);

    $pdfData = curl_exec($ch);

    if ($pdfData === false) {
        http_response_code(500);
        exit('Download error: ' . curl_error($ch));
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        http_response_code($httpCode);
        exit('Remote PDF not available');
    }

    echo $pdfData;
    exit;
}


if(isset($_GET['pid'])){

$pdf_id = $_GET['pid'];

$host = 'https://bestpaystub.com';
// $host = 'http://localhost/wpbox.com';

$pdfUrl = $host."/wp-content/plugins/bestpaystub-calculator/APP/download/pdfs/".$pdf_id;
$filename = "Paystub_" . time() . ".pdf";

download_pdf_to_browser($pdfUrl, $filename);

}