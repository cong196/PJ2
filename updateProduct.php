<?php
    use Automattic\WooCommerce\Client;
    require __DIR__ . '/vendor/autoload.php';
    include "config.php";

    $id = $_POST['id'];
    $title = $_POST['title'];
    $des = $_POST['des'];
    $s = $_POST['site'];

    $site = json_decode(getKey($s));

    function updateproduct($data,$site,$id){ 
        $woocommerce = new Client(
        $site->url, 
        $site->ck, 
        $site->cs,
            [
                'version' => 'wc/v3',
            ]
        );
    
      $response = $woocommerce->put('products/'. $id, $data);
      return $response;
    };

    $data = [
        'name' => $title,
        'description' => $des
    ];

    $woocommerce = new Client(
        $site->url, 
        $site->ck, 
        $site->cs,
            [
                'version' => 'wc/v3',
            ]
    );
    
    $response = $woocommerce->put('products/'. $id, $data);
    //return $response;

    //$res1 = updateproduct($data,$site,$id);

    echo $response->id;
    //echo json_encode($res1);
    //echo $site->url;
     // echo $_POST['id'] ."<br />";
     // echo $_POST['des'] ."<br />";
      //echo "==============================<br />";
      //echo "All Data Submitted Successfully!";
      
      //echo $id;

?>