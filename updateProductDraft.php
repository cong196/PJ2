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
    $slug = $_POST['slug'];
    $isCustomkeywords = $_POST['isCustomkeywords'];
    $isSavekeywords = $_POST['isSavekeywords'];
    $keyword = $_POST['keyword'];
    $keywordvolume = $_POST['keywordvolume'];
    $keywordtype = $_POST['keywordtype'];
    $categoryKeyword = $_POST['categoryKeyword'];
    $price = $_POST['price'];

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

    function get1Product($site,$page){
      $woocommerce = new Client(
            $site->url, 
            $site->ck, 
            $site->cs,
          [
              'version' => 'wc/v3',
          ]
      );
      $listCategory = $woocommerce->get('products/?orderby=date&status=publish&page=1&per_page=1');
       return $listCategory;
    };

    $slug = strtolower($slug);
    $slug = preg_replace('/[^a-zA-Z0-9\s]/', '', $slug);
    $slug = str_replace(' ', '-', $slug);

    date_default_timezone_set('America/Los_Angeles');
    $date = date('y-m-d h:i:s');
    $des = str_replace('<img', '<img class="aligncenter"', $des);
    $data = [
            'name' => $title,
            'description' => $des,
            'date_created' => $date,
            'slug' => $slug,
            'price' => $price,
            'regular_price' => $price
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
        deleteScheduleProduct($id,$s);
    }
    
    $response = updateproduct($data,$site,$id);
    $prd1 = get1Product($site,1);
    $ids1 = array_column($prd1[0]->categories, 'id');
    $idText1 = implode(', ', $ids1);
    updateProductlink($s,$prd1[0]->id,$prd1[0]->name,$prd1[0]->slug, $idText1);

    if($isCustomkeywords == 1){
        if($isSavekeywords == 1) {
            insertkeywords($s,$categoryKeyword,$keyword,$keywordvolume,$keywordtype);
        }
    }
    echo $response . "- is custom: ". $isCustomkeywords . " is save: ". $isSavekeywords ." - " . $categoryKeyword . "-". $keywordvolume . "-". $keyword . "-". $keywordtype;    

?>