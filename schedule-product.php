<?php

  use Automattic\WooCommerce\Client;
  require __DIR__ . '/vendor/autoload.php';

  include "dbConnect.php";
  include "config.php";

  //addScheduleProduct(324243,'themegatee');
  $id = getScheduleProductId('themega-editdraftproduct.php');
  $site = json_decode(getKey('themegatee'));
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
            'status' => 'publish'
  ];
  if($id != 0) {
    updateproduct($data,$site,$id);
    deleteScheduleProduct($id,'themega-editdraftproduct.php');
  }
?>