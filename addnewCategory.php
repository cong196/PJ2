<?php
    use Automattic\WooCommerce\Client;
    require __DIR__ . '/vendor/autoload.php';
    use Orhanerday\OpenAi\OpenAi;
    include "config.php";
    include "dbConnect.php";
    $s =  $_POST['site'];
    $tag =  $_POST['tag'];
    $parent = $_POST['parent'];
    $site = json_decode(getKey($s));
    $data = [];
    if($parent == '') {
        $data = [
            'name' => $tag
        ];
    } else {
        $data = [
            'name' => $tag,
            'parent' => $parent
        ];
    }
    

    function createCategory($data,$site){
        $woocommerce = new Client(
        $site->url, 
        $site->ck,
        $site->cs,
            [
                'version' => 'wc/v3',
            ]
        );
        $tagName = $data['name'];
        $allTags = $woocommerce->get('products/categories');
        $tagExists = false;
        $tagsExistsID = 0;
        foreach ($allTags as $tag) {
            if (strtolower($tag->name) === strtolower($tagName)) {
                $tagExists = true;
                $tagsExistsID = $tag->id;
                break;
            }
        }

        if (!empty($tagExists)) {
            $response1 = $woocommerce->get('products/categories/' + $tagsExistsID);
            updateCategory($s,$response1->id,$response1->name,$response1->slug,$response1->parent);
            addCategoryTerms($response1->name);
            return "0";
        }

        $response = $woocommerce->post('products/categories', $data);
        return $response->id . ",". $response->name."," . $response->slug .",". $response->parent;
    };



    $response = createCategory($data,$site);
    if ($response == "0") {
        echo "0";
    } else {
        //echo $response;
        $ds = explode(",", $response);
        updateCategory($s,$ds[0],$ds[1],$ds[2],$ds[3]);
        addCategoryTerms($ds[1]);
        echo $response;
    }

?>