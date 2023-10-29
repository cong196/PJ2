<?php

use Automattic\WooCommerce\Client;
require __DIR__ . '/vendor/autoload.php';

include "dbConnect.php";
include "config.php";
$site = json_decode(getKey('themegatee'));

function getProducts($site){
  $woocommerce = new Client(
        $site->url, 
        $site->ck, 
        $site->cs,
      [
          'version' => 'wc/v3',
      ]
  );
  $prds = $woocommerce->get('products/61990');
  
  return $prds;
};
  print_r(getProducts($site));

?>