<?php 
	use Automattic\WooCommerce\Client;
    require __DIR__ . '/vendor/autoload.php';
    include "config.php";
    include "dbConnect.php";
    $pagename = $_POST['site'];
    $site = json_decode(getKey($pagename));


    function get90Product($site,$page,$perpage){
	  $woocommerce = new Client(
	        $site->url, 
	        $site->ck, 
	        $site->cs,
	      [
	          'version' => 'wc/v3',
	      ]
	  );
	  $listCategory = $woocommerce->get('products/?status=publish&page='.$page.'&per_page='.$perpage);
	   return $listCategory;
	};

	//$list = get30Category($site);
	//$data_arr = array();
	//echo json_encode($list);
	//echo $pagename;
	$cur = 90;
	$listCat = get90Product($site,1,90);
	$page = 1;
	$next = 1;
	$i0 = 0;
	//deletTableTag($pagename);
	
	while($i0 < count($listCat)) {
		//$dataCategory = json_decode($listCat[$i0]->categories, true);

		$ids = array_column($listCat[$i0]->categories, 'id');
		$idText = implode(', ', $ids);

		updateProductlink($pagename,$listCat[$i0]->id,$listCat[$i0]->name,$listCat[$i0]->slug, $idText);
		$i0++;
	}

	while(count($listCat) == 90){
		$page = $page + 1;
		$i1 = 0;
		$listCat = get90Product($site,$page,90);
		while($i1 < count($listCat)) {

			$ids1 = array_column($listCat[$i1]->categories, 'id');
			$idText1 = implode(', ', $ids1);
			updateProductlink($pagename,$listCat[$i1]->id,$listCat[$i1]->name,$listCat[$i1]->slug, $idText1);
			$i1++;
		}
		
	}
	
	//echo count($listCat);
	return count($listCat);
?>