<?php
    use Automattic\WooCommerce\Client;
    require __DIR__ . '/vendor/autoload.php';
    include "dbConnect.php";
    include "config.php";

    $id = $_POST['id'];
    $title = $_POST['title'];
    $des = $_POST['des'];
    $s = $_POST['site'];
    $category = $_POST['category'];
    $publishss = $_POST['publishss'];
    $selectTag = $_POST['selectTag'];
    
    //$selectCategory = json_encode($_POST['selectCategory']);

    //print($selectCategory);

    $site = json_decode(getKey($s));

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
      return $response->id;
    };

    //$data = [];

    date_default_timezone_set('America/Los_Angeles');
    $date = date('y-m-d h:i:s');

    $data = [
            'name' => $title,
            'description' => $des,
            "date_created" => $date
    ];

    if($category != '') {

        $arrCat = explode(",", $category);

        $data_arr = [];
        foreach ($arrCat as $item) {
            $new['id'] = $item;
            array_push($data_arr,$new);
        }
        $data['categories'] = $data_arr;
    }

    if($selectTag != '') {

        $arrTag = explode(",", $selectTag);

        $data_arrTag = [];
        foreach ($arrTag as $itemtag) {
            $newtag['id'] = $itemtag;
            array_push($data_arrTag,$newtag);
        }
        $data['tags'] = $data_arrTag;
    }


    if($publishss == 1) {
        $data['status'] = 'publish';
    }
    
    $response = updateproduct($data,$site,$id);
    echo $response;

    /*$data = [
        'name' => $title,
        'description' => $des,
        'categories' => [['id'=>123]]
    ];

    $woocommerce = new Client(
    $site->url, 
    $site->ck, 
    $site->cs,
        [
            'version' => 'wc/v3',
        ]
    );
    $response = $woocommerce->put('products/'. $id, $data);
    echo $response->id;*/    

?>