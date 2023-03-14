<?php

/*//include "lib/dbConn.php";
function getNew(){

	
			$qr ="
		SELECT * FROM site
		ORDER BY id DESC
		LIMIT 0,1
	";
	//echo 'ff';
	//echo mysqli_query(mysqli_connect('localhost', 'root', '', 'project1'),$qr);
		return mysqli_query(mysqli_connect('localhost', 'root', '', 'project1'),$qr);
		
		
	
	//return "1111";
}
function get10product(){
	//$response  = file_get_contents('https://www.air-yeezyshoes.com/wp-json/wc/v3/products');
	// Create a stream
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header' => "Authorization: Basic " . base64_encode("ck_7f490c4fefdd04d47066071483aa3386261cd328:cs_0ca5c992744974f52076f2ef16dfa83e2278202a")           
  )
);

$context = stream_context_create($opts);

// Open the file using the HTTP headers set above
$file = file_get_contents('https://www.air-yeezyshoes.com/wp-json/wc/v3/products', false, $context);

	$s10prx = json_decode($file, false);
}*/


      
    //<?php echo print_r($woocommerce->get('products')); ?>

?>