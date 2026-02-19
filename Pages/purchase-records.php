
<div class="shadow font" style="margin-top: 20px;margin-right: 10px;">
<h1>Orders / PDF Records</h1>
<p>Here you can view all the orders.</p>

<?php 
$msg = '';
$path = plugins_url('/../APP/print/records.json',__FILE__);
$config = file_get_contents($path);
$config = json_decode($config,true);

// echo "<pre>";print_r($config);echo"</pre>";


function map_by_id(array $data): array {
    $out = [];
    foreach ($data as $row) {
        if (isset($row['id'])) {
            $out[$row['id']] = $row['v'] ?? '';
        }
    }
    return $out;
}

?>


<table class="order-data" border="0" cellpadding="10" cellspacing="0" width="100%" style="border-collapse:collapse;">
    <thead>
        <tr style="background:#f5f5f5;">
            <th>Date</th>
            <th>Payer Email</th>
            <th>PayPal Transaction ID</th>
            <th>Company Name</th>
            <th>Employee Name</th>
            <th>View PDF</th>
        </tr>
    </thead>
    <tbody>

<?php 
if(is_array($config)){

 uasort($config, function ($a, $b) {
        return strtotime($b['updated_at'] ?? '') <=> strtotime($a['updated_at'] ?? '');
    });

foreach ($config as $order_id => $order){ 

	?>

<?php
    $mapped = map_by_id($order['data']["main_data"]);

    $date       = $order['updated_at'] ?? '';
    $payer_email = $order['payer_email'] ?? '';
    $txn_id     = $order['pypl_id'] ?? '';
    $company    = $mapped['p5'] ?? '-';
    $employee   = $mapped['p7'] ?? '-';
    $pdf_id   = $mapped['pdf_id'] ?? '';

    $date = explode(" ", $date)[0];

    // Example PDF URL (adjust path as needed)
    $pdf_url = plugins_url("/../d/?pid=paystub_{$order_id}.pdf", __FILE__);
?>

<tr style="border-bottom:1px solid #ddd;">
    <td><?php echo esc_html($date); ?></td>
    <td><?php echo esc_html($payer_email); ?></td>
    <td><?php echo esc_html($txn_id); ?></td>
    <td><?php echo esc_html($company); ?></td>
    <td><?php echo esc_html($employee); ?></td>
    <td>
        <a href="<?php echo esc_url($pdf_url); ?>" target="_blank">
            View PDF
        </a>
    </td>
</tr>

<?php }} ?>

    </tbody>
</table>



</div>


<style>
	.order-data{
		text-align: center;
	}
</style>