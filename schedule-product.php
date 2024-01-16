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

  $id_kaco = getScheduleProductId('kacogifts-editdraftproduct.php');
  if($id_kaco != 0) {
    $site_kaco = json_decode(getKey('kacogifts'));
    updateproduct($data,$site_kaco,$id_kaco);
    deleteScheduleProduct($id_kaco,'kacogifts-editdraftproduct.php');
  }

  $id_customyoy = getScheduleProductId('customjoygifts-editdraftproduct.php');
  if($id_customyoy != 0) {
    $site_customyoy = json_decode(getKey('customjoygifts'));
    updateproduct($data,$site_customyoy,$id_customyoy);
    deleteScheduleProduct($id_customyoy,'customjoygifts-editdraftproduct.php');
  }

  $id_printfusionusa = getScheduleProductId('printfusionusa-editdraftproduct.php');
  if($id_printfusionusa != 0) {
    $site_printfusionusa = json_decode(getKey('printfusionusa'));
    updateproduct($data,$site_printfusionusa,$id_printfusionusa);
    deleteScheduleProduct($id_printfusionusa,'printfusionusa-editdraftproduct.php');
  }

?>