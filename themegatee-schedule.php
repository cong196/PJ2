<?php
    use Automattic\WooCommerce\Client;
    require __DIR__ . '/vendor/autoload.php';
    use Orhanerday\OpenAi\OpenAi;
    include "config.php";
    include "dbConnect.php";
    $site = json_decode(getKey('themegatee'));

    

?>