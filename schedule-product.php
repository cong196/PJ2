<?php

  use Automattic\WooCommerce\Client;
  require __DIR__ . '/vendor/autoload.php';

  include "dbConnect.php";
  include "config.php";
  
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
      return json_encode($response);
  };


  $currentTimestamp = time();
  $newTimestamp = $currentTimestamp - 5 * 3600;
  $newDate = gmdate('Y-m-d\TH:i:s', $newTimestamp);
  $data = [
            'status' => 'publish',
            'date_created' => $newDate
  ];

  $id = getScheduleProductId('themega-editdraftproduct.php');
  $site = json_decode(getKey('themegatee'));
  if($id != 0) {
    $res = json_decode(updateproduct($data,$site,$id),true);
    $product_name = $res['name'];
    $product_slug = $res['slug'];
    $category_ids = [];
    foreach ($res['categories'] as $category) {
        $category_ids[] = $category['id'];
    }
    $category_ids_string = implode(',', $category_ids);
    updateProductlink('themega-editdraftproduct.php',$id,$product_name,$product_slug,$category_ids_string);

    deleteScheduleProduct($id,'themega-editdraftproduct.php');
  }

  $id_kaco = getScheduleProductId('kacogifts-editdraftproduct.php');
  if($id_kaco != 0) {
    $site_kaco = json_decode(getKey('kacogifts'));
    $res = json_decode(updateproduct($data,$site_kaco,$id_kaco),true);

    $product_name = $res['name'];
    $product_slug = $res['slug'];
    $category_ids = [];
    foreach ($res['categories'] as $category) {
        $category_ids[] = $category['id'];
    }
    $category_ids_string = implode(',', $category_ids);
    updateProductlink('kacogifts-editdraftproduct.php',$id_kaco,$product_name,$product_slug,$category_ids_string);

    deleteScheduleProduct($id_kaco,'kacogifts-editdraftproduct.php');
  }

  $id_customyoy = getScheduleProductId('customjoygifts-editdraftproduct.php');
  if($id_customyoy != 0) {
    $site_customyoy = json_decode(getKey('customjoygifts'));
    $res = json_decode(updateproduct($data,$site_customyoy,$id_customyoy),true);
    $product_name = $res['name'];
    $product_slug = $res['slug'];
    $category_ids = [];
    foreach ($res['categories'] as $category) {
        $category_ids[] = $category['id'];
    }
    $category_ids_string = implode(',', $category_ids);
    updateProductlink('customjoygifts-editdraftproduct.php',$id_customyoy,$product_name,$product_slug,$category_ids_string);

    deleteScheduleProduct($id_customyoy,'customjoygifts-editdraftproduct.php');
  }

  $id_printfusionusa = getScheduleProductId('printfusionusa-editdraftproduct.php');
  if($id_printfusionusa != 0) {
    $site_printfusionusa = json_decode(getKey('printfusionusa'));
    $res = json_decode(updateproduct($data,$site_printfusionusa,$id_printfusionusa),true);
    $product_name = $res['name'];
    $product_slug = $res['slug'];
    $category_ids = [];
    foreach ($res['categories'] as $category) {
        $category_ids[] = $category['id'];
    }
    $category_ids_string = implode(',', $category_ids);
    updateProductlink('printfusionusa-editdraftproduct.php',$id_printfusionusa,$product_name,$product_slug,$category_ids_string);
    deleteScheduleProduct($id_printfusionusa,'printfusionusa-editdraftproduct.php');
  }

?>