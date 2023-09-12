<?php
    use Automattic\WooCommerce\Client;
    require __DIR__ . '/vendor/autoload.php';
    use Orhanerday\OpenAi\OpenAi;
    include "config.php";
    include "dbConnect.php";
    $s =  $_POST['site'];
    $tag =  $_POST['tag'];
    $site = json_decode(getKey($s));

    $data = [
        'name' => $tag
    ];

    function createTag($data,$site){
        $woocommerce = new Client(
        $site->url, 
        $site->ck,
        $site->cs,
            [
                'version' => 'wc/v3',
            ]
        );
        $tagName = $data['name'];
        //$tagExists = $woocommerce->get('products/tags', ['name' => $tagName]);
        $allTags = $woocommerce->get('products/tags');
        $tagExists = false;
        foreach ($allTags as $tag) {
            if (strtolower($tag->name) === strtolower($tagName)) {
                $tagExists = true;
                break;
            }
        }

        if (!empty($tagExists)) {
            return "0";
        }

        $response = $woocommerce->post('products/tags', $data);
        return $response->id . ",". $response->name."," . $response->slug;
    };

    $response = createTag($data,$site);
    if ($response == "0") {
        echo "0";
    } else {
        //echo $response;
        $ds = explode(",", $response);
        updateTag($s,$ds[0],$ds[1],$ds[2]);
        echo $response;
    }

?>