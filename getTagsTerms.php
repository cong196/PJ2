<?php 
    include "dbConnect.php";
    $title = $_POST['title'];
	function tagbyTitle($title) {
	    $textList = get_tags_terms_2();
	    return findMatch($textList, $title);
	}


	function findMatch($textList, $str) {
	    $matches = [];
	    foreach ($textList as $text) {
	        if (stripos($str, $text) !== false) {
	            $matches[] = $text;
	        }
	    }
	    return implode(',', $matches);
	}

	function productTypebyTitle($title) {
	    /*$titleClassifier = [
	        'categories' => [
	            "hoodie" => "hoodie",
	            "shirt" => "shirt",
	            "hawaiian shirt" => "shirt",
	            "crocs" => "shoes",
	            "jordan 13" => "shoes",
	            "sneaker" => "shoes",
	            "sweatshirt" => "sweater",
	            "sweater" => "sweater"
	        ]
	    ];*/

	    $titleClassifier = get_product_type_terms();
	    $lowerCaseTitle = strtolower($title);
	    foreach ($titleClassifier['categories'] as $keyword => $category) {
	        if (strpos($lowerCaseTitle, $keyword) !== false) {
	            return $category;
	        }
	    }
	    return "";
	}
	$tags = tagbyTitle($title);
	$productType = productTypebyTitle($title);

	if ($tags === '') {
	    echo "";
	} else {
	    if ($productType === '') {
	        echo $tags;
	    } else {
	        $data = explode(',', $tags);
	        $extendedType = array_map(function($name) use ($productType) {
	            return trim($name) . ' ' . $productType;
	        }, $data);
	        echo implode(',', array_merge($data, $extendedType));
	    }
	}
?>