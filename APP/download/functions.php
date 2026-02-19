<?php

function end_point_happs(){
	return base64_decode('aHR0cHM6Ly9jYWxjdWxhdG9yZXhwcmVzcy5jb20vQVBJMTAvTWFsaWtfU2FsYWh1ZGRpbl9VV192Mw==');
}

function download_pdf($url = "")
{
    $saveDir = __DIR__ . "/pdfs/";

    // Create dir if missing
    if (!is_dir($saveDir)) {
        mkdir($saveDir, 0755, true);
    }
    
    $pdf_id = $_POST['pdf_uid'];
    // $filename = 'paystub_' . time() . '.pdf';

    $filename = 'paystub_' . $pdf_id . '.pdf';
    $filePath = $saveDir . $filename;

    $fp = fopen($filePath, 'wb');
    if (!$fp) {
        throw new RuntimeException("Cannot write to file: {$filePath}");
    }

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_FILE           => $fp,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT        => 60,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_USERAGENT      => 'PDF-Downloader/1.0',
    ]);

    $success = curl_exec($ch);

    if ($success === false) {
        fclose($fp);
        unlink($filePath);
        throw new RuntimeException(curl_error($ch));
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);
    fclose($fp);

    if ($httpCode !== 200) {
        unlink($filePath);
        throw new RuntimeException("Download failed. HTTP {$httpCode}");
    }

    return $filename;
}


function create_pdf(){

$ux = end_point_happs() . '/download/index.php';
$ux_data = $_POST;

$ch = curl_init($ux);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $ux_data);
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    // echo 'Error: ' . curl_error($ch);
} else {


// echo $response;
$pdf = json_decode($response,true);
$pdf = end_point_happs() . "/download/pdfs/".$pdf["pdf"];
return download_pdf($pdf);
// return $response;
}


curl_close($ch);



}