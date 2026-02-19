<?php
declare(strict_types=1);

// echo "<pre>";print_r($_POST);echo"</pre>";
/*
|--------------------------------------------------------------------------
| CONFIG
|--------------------------------------------------------------------------
*/
$configFile = __DIR__ . '/config.json';

/*
|--------------------------------------------------------------------------
| HELPERS
|--------------------------------------------------------------------------
*/
function fail(string $msg): void {
    die('<div style="padding:20px;font-family:Arial;color:#7f1d1d;">' . htmlspecialchars($msg) . '</div>');
}

function is_masked(string $val): bool {
    return strpos($val, '*') !== false;
}

/*
|--------------------------------------------------------------------------
| LOAD EXISTING CONFIG
|--------------------------------------------------------------------------
*/
$existing = [
    'client_id'  => '',
    'client_key' => ''
];

if (is_file($configFile)) {
    $json = file_get_contents($configFile);
    $decoded = json_decode($json, true);
    if (is_array($decoded)) {
        $existing = array_merge($existing, $decoded);
    }
}

/*
|--------------------------------------------------------------------------
| HANDLE SAVE
|--------------------------------------------------------------------------
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {

    // read raw input safely
    $clientInput = trim($_REQUEST['client_id'] ?? '');
    $keyInput    = trim($_REQUEST['client_key'] ?? '');

    // CLIENT ID
    if ($clientInput !== '') {
        if (!is_masked($clientInput)) {
            $existing['client_id'] = $clientInput;
        }
        // else: masked → keep old value
    }

    // SECRET KEY
    if ($keyInput !== '') {
        if (!is_masked($keyInput)) {
            $existing['client_key'] = $keyInput;
        }
    }

    // basic validation
    if ($existing['client_id'] === '' || $existing['client_key'] === '') {
        fail('Both Client ID and Secret Key are required.');
    }

    
    $existing['product_title'] =  trim($_REQUEST['product_title'] ?? '');
    $existing['product_desc'] =  trim($_REQUEST['product_desc'] ?? '');
    $existing['price'] =  trim($_REQUEST['price'] ?? '');


    // save JSON (pretty + readable)
    $jsonOut = json_encode(
        $existing,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
    );

    if ($jsonOut === false) {
        fail('Failed to encode configuration.');
    }

    if (file_put_contents($configFile, $jsonOut) === false) {
        fail('Failed to write config.json (check permissions).');
    }

    // redirect back (WordPress-style)
    // header('Location: ' . $_SERVER['HTTP_REFERER'] . '&saved=1');
    exit;
}

fail('Invalid request');
