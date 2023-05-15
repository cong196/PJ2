<?php 
	use Automattic\WooCommerce\Client;
    require __DIR__ . '/vendor/autoload.php';
    include "config.php";
    include "dbConnect.php";
    $pagename = $_POST['site'];
    $site = json_decode(getKey($pagename));


    function get30Category($site,$page,$perpage){
	  $woocommerce = new Client(
	        $site->url, 
	        $site->ck, 
	        $site->cs,
	      [
	          'version' => 'wc/v3',
	      ]
	  );
	  $listCategory = $woocommerce->get('products/categories?page='.$page.'&per_page='.$perpage);
	   return $listCategory;
	};

	//$list = get30Category($site);
	//$data_arr = array();
	//echo json_encode($list);
	//echo $pagename;
	$cur = 30;
	$listCat = get30Category($site,1,30);
	$page = 1;
	$next = 1;
	$i0 = 0;
	deletTableCategory($pagename);
	
	while($i0 < count($listCat)) {
		updateCategory($pagename,$listCat[$i0]->id,$listCat[$i0]->name,$listCat[$i0]->slug);
		$i0++;
	}

	while(count($listCat) == 30){
		$page = $page + 1;
		$i1 = 0;
		$listCat = get30Category($site,$page,30);
		while($i1 < count($listCat)) {
			updateCategory($pagename,$listCat[$i1]->id,$listCat[$i1]->name,$listCat[$i1]->slug);
			$i1++;
		}
		
	}
	
	//echo count($listCat);
	return count($listCat);
?>