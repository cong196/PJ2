<?php 
	use Automattic\WooCommerce\Client;
    require __DIR__ . '/vendor/autoload.php';
    require_once("wordpress/wp-load.php");
    include "config.php";
    include "dbConnect.php";
    $pagename = $_POST['site'];
   

    $api_url = 'https://themegatee.com/wp-json/wp/v2/categories?per_page=50';
	$username = 'khajob96';
	$password = 'vjkdh65734$%#$';

	


    function get50Category($api_url,$username,$password,$page){
    	$api_url = $api_url . '&page='.$page;
	  $args = array(
		    'headers' => array(
		        'Authorization' => 'Basic ' . base64_encode($username . ':' . $password)
		    )
		);

		$response = wp_remote_get($api_url, $args);
		if (is_wp_error($response)) {
		    echo 'Error: ' . $response->get_error_message();
		    exit;
		}
		$response_body = wp_remote_retrieve_body($response);
		$data = json_decode($response_body, true);

		return $data;
	};
	
	$cur = 50;
	$page = 1;
	$listCat = get50Category($api_url,$username,$password,$page);
	echo json_encode($listCat);
	$next = 1;
	$i0 = 0;
	deletTablePostCategory($pagename);
	if (is_array($listCat)) {
		while($i0 < count($listCat)) {
			updatePostCategory($pagename,$listCat[$i0]['id'],$listCat[$i0]['name'],$listCat[$i0]['slug'],$listCat[$i0]['parent']);
			$i0++;
		}

		while(count($listCat) == 10){
			$page = $page + 1;
			$i1 = 0;
			$listCat = get50Category($api_url,$username,$password,$page);
			while($i1 < count($listCat)) {
				updatePostCategory($pagename,$listCat[$i0]['id'],$listCat[$i0]['name'],$listCat[$i0]['slug'],$listCat[$i0]['parent']);
				$i1++;
			}
			
		}
	}
	
	//echo count($listCat);
	return count($listCat);
?>