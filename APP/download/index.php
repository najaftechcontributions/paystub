<?php
ini_set('max_execution_time', '300'); // 300 sec = 5 min

include __DIR__.'/functions.php';
include __DIR__.'/../pypl/functions.php';


$trans_id = $_POST['trans_id'] ?? "";
$x =  verify_paypal_capture($trans_id);
$status = $x["status"] ?? "PENDING";

if($status !== "COMPLETED"){
    echo "ERROR_PAYMENT_PENDING";
	return 0;
}else{
	// echo "ALL_GOOD";
	// return 0;
}



// echo $json = create_pdf();

$res = [
"pdf" => create_pdf()
];

echo json_encode($res);