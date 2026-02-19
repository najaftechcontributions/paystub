<?php 

function CREATE_PAYSTUB_TB(){
global $wpdb;
$table_name = "paystub_calculator";

if ( $wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") != $table_name ) {

$sql = "CREATE TABLE $table_name (

`no` INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`trans_id`VARCHAR(255) DEFAULT NULL,
`email`VARCHAR(255) DEFAULT NULL,
`status`VARCHAR(255) DEFAULT NULL,
`pdf`VARCHAR(255) DEFAULT NULL
    );";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

}


}


function DEL_PAYSTUB_TB(){

global $wpdb;
    $table_name = "paystub_calculator";
     $sql = "DROP TABLE IF EXISTS $table_name";
     $wpdb->query($sql);

}



?>