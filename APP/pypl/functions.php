<?php
function create_pypl_js(){
// $config_path = plugins_url('/../Admin/pypl/config.json',__FILE__);
$config_path = __DIR__.'/../Admin/pypl/config.json';
$pypl_config_json = file_get_contents($config_path);
$pypl_config = json_decode($pypl_config_json, true);

$js = file_get_contents(
// plugins_url('/../Admin/pypl/t.js',__FILE__)
$config_path = __DIR__.'/../Admin/pypl/t.js'

);

$data = str_replace(
[
'#desc#',
'#price#',
'#title#'
]
, [

$pypl_config['product_desc'],
$pypl_config['price'],
$pypl_config['product_title']

], $js);


// $js_path = plugins_url('/../pypl/btns.js',__FILE__);
// $file2write = fopen($js_path, "w") or die("Unable to open file!");
// $text2write = $data;
// fwrite($file2write, $text2write);
// fclose($file2write);

return $data;
}


function credentials($type="test"){

// $config_path = plugins_url('/../Admin/pypl/config.json',__FILE__);
$config_path = __DIR__.'/../Admin/pypl/config.json';

$pypl_config_json = file_get_contents($config_path);
$pypl_config = json_decode($pypl_config_json, true);

$test_client = $pypl_config["client_id"];
$test_secret = $pypl_config["client_key"];


return [
"client" => trim($test_client),
"secret" => trim($test_secret)
];

}

function sandbox_filter($url){
$is_sandboxed = true;

if(!$is_sandboxed){
$url = str_replace("sandbox.", "", $url);
}

return $url;
}

function paypal_get_access_token() {
    $clientId = credentials()["client"];//'SANDBOX_CLIENT_ID';
    $secret   = credentials()["secret"];//'SANDBOX_SECRET';

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => sandbox_filter("https://api-m.sandbox.paypal.com/v1/oauth2/token"),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERPWD => "$clientId:$secret",
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => "grant_type=client_credentials",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Accept-Language: en_US"
        ]
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    return $data['access_token'] ?? null;
}



function verify_paypal_capture($captureId) {
    $accessToken = paypal_get_access_token();
    if (!$accessToken) {
        return ['error' => 'Unable to get PayPal access token'];
    }

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => 
        sandbox_filter("https://api-m.sandbox.paypal.com/v2/payments/captures/$captureId"),
        
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "Authorization: Bearer $accessToken"
        ]
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

function paystub_compute_totals($paystubs, $depositSlip) {
    // Ideally load these from config.json too
    $STUB = 4.99;
    $DEP  = 1.99;

    $stubQty = max(1, intval($paystubs));
    $depQty  = $depositSlip ? $stubQty : 0;

    $stubTotal = $stubQty * $STUB;
    $depTotal  = $depQty * $DEP;
    $grand     = $stubTotal + $depTotal;

    // Return both float + cents (cents is best for comparisons)
    return [
        'stub_unit' => $STUB,
        'stub_qty'  => $stubQty,
        'stub_total'=> round($stubTotal, 2),

        'dep_unit'  => $DEP,
        'dep_qty'   => $depQty,
        'dep_total' => round($depTotal, 2),

        'grand'     => round($grand, 2),
        'grand_cents' => (int) round($grand * 100),
    ];
}
