
<div class="shadow font" style="margin-top: 20px;margin-right: 10px;">
<h1>Paypal Settings</h1>
<p>Configure settings for the paypal here.</p>

<?php 
$msg = '';
$path = plugins_url('/../APP/Admin/pypl/config.json',__FILE__);
$config = file_get_contents($path);
$config = json_decode($config,true);

$client = HAPPS_MASK($config["client_id"] ?? "");
$key = HAPPS_MASK($config["client_key"] ?? "");
$product_title = $config["product_title"] ?? "";
$product_desc = $config["product_desc"] ?? "";
$price = $config["price"] ?? "";

if(isset($_GET['config_saved']) && $_GET['config_saved'] == "1"){
	$msg = 'Sattings Saved.'; 
}

?>

<form onsubmit="save_config();return false;" id="pypl-form">
	<table class="tbx">
		<tr>
			<td>CLIENT ID</td>
			<td><input type="text" class="khyzer" name="client_id" placeholder="Enter" value="<?php echo $client; ?>" required></td>
		</tr>

		<tr>
			<td>SECRET KEY</td>
			<td><input type="text" class="khyzer" name="client_key" placeholder="Enter" value="<?php echo $key; ?>" required></td>
		</tr>


		<tr>
			<td>Product Title (This will appear on charge in your paypal dashboard)</td>
			<td><input type="text" class="khyzer" name="product_title" placeholder="Enter" value="<?php echo $product_title; ?>" required></td>
		</tr>


		<tr>
			<td>Product Description (This will appear on charge in your paypal dashboard)</td>
			<td><input type="text" class="khyzer" name="product_desc" placeholder="Enter" value="<?php echo $product_desc; ?>" required></td>
		</tr>


		<tr>
			<td>Price (USD)</td>
			<td><input type="number" class="khyzer" name="price" placeholder="Enter" value="<?php echo $price; ?>" required></td>
		</tr>

		<tr><td colspan="2">
			<div style="height:50px;"></div>
			<h2><?php echo $msg; ?></h2>

			<button type="submit" class="btn">Save Settings</button>
		</td></tr>
	</table>
</form>

</div>

<script src="<?php echo plugins_url('/../APP/JS/jquery.min.js',__FILE__); ?>"></script>
<script>
	function save_config(){
      var form_data = $('#pypl-form').serialize();
      console.log(form_data); 
    
      $.ajax({
        url : "<?php echo plugins_url('/../APP/Admin/pypl/index.php',__FILE__); ?>",
        type: 'POST',
        data : form_data,
        cache: false,
      }).done(function(response){ //
       
       console.log(response);
        window.open("?page=paypal_settings_PSC_happs&config_saved=1","_self"); 
    
    });
    
	}
</script>
<style>
	table.tbx{
		width: 100%;
		max-width: 900px;
	}

	table.tbx td{
		display: block;
		margin:12px 0;
	}

	table.tbx td:nth-child(1){
		font-weight: 400;
		color: #FF5722;
	}

	table.tbx input.khyzer{
		width:100%;
	}
</style>







