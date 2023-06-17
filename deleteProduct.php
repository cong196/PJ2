<?php
    use Automattic\WooCommerce\Client;
    require __DIR__ . '/vendor/autoload.php';
    include "dbConnect.php";
    include "config.php";

    $id = $_POST['id'];
    $url = $_POST['site'];

    $site = json_decode(getKey($url));

    function deleteproductsite($id,$site){ 
        $woocommerce = new Client(
        $site->url, 
        $site->ck,
        $site->cs,
            [
                'version' => 'wc/v3',
            ]
        );
    
      $response = $woocommerce->delete('products/'.$id, ['force' => true]);
      return $response->id;
    };

    $idarr = explode("-", $id);

    if(deleteproductsite($idarr[0],$site) == $idarr[0]) {
        echo 1;
    } else {
        echo 2;
    }

?>