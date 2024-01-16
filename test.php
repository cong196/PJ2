<?php

use Automattic\WooCommerce\Client;

require __DIR__ . '/vendor/autoload.php';

include "dbConnect.php";
include "config.php";

$site = json_decode(getKey('printfusionusa'));

function createCategory($site)
{
    $woocommerce = new Client(
        $site->url,
        $site->ck,
        $site->cs,
        [
            'version' => 'wc/v3',
        ]
    );

    // Data for creating the category
    $data = [
        'name' => 'Dallas Cowboys',
        'id' => 10, // Set the desired category ID
    ];

    // Create the category
    $category = $woocommerce->post('products/categories', $data);

    return $category;
}

try {
    $result = createCategory($site);
    print_r($result);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
