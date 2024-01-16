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

    $woocommerce = new Client(
            $site->url,
            $site->ck,
            $site->cs,
            [
                'version' => 'wc/v3',
            ]
        );
        
    $page = 1;
    $params = [
        'per_page' => 100,
        'page' => $page,
    ];
    $categories = $woocommerce->get('products/categories',$params);
   
    $category_exists = false;
    $is_continue = true;
    $id_category_exists = 0;
    $slug_category_exits = '';
    $id_parent_category_exists = 0;
    while(count($categories) == 100 && !$category_exists) {
        
        foreach ($categories as $category) {
            if (strtolower($category->name) === strtolower($data['name'])) {
                $category_exists = true;
                $id_category_exists = $category->id;
                $slug_category_exits = $category->slug;
                break;
            }
        }
        $page = $page + 1;
        $params = [
            'per_page' => 100,
            'page' => $page,
        ];
        $categories = $woocommerce->get('products/categories',$params);
    }
    

    if ($category_exists) {
        updateCategory($s,$id_category_exists,$tag,$slug_category_exits, $id_parent_category_exists);
        addCategoryTerms($tag);
        echo 'Sucess !';

        //return $response->id . ",". $response->name."," . $response->slug .",". $response->parent;
    } else {
        $woocommerce = new Client(
            $site->url,
            $site->ck,
            $site->cs,
            [
                'version' => 'wc/v3',
            ]
        );
        $res = $woocommerce->post('products/categories', $data);
        updateCategory($s,$res->id,$tag,$res->slug, $res->parent);
        addCategoryTerms($tag);
        echo $res->id . ",". $res->name."," . $res->slug .",". $res->parent;
        //echo 'Sucess 1';
    }
?>