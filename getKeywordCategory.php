<?php
require __DIR__ . '/vendor/autoload.php';
use Orhanerday\OpenAi\OpenAi;
include "config.php";
include "dbConnect.php";

if(isset($_POST['category'])) {
    // Get the category value from the POST data
    $category = $_POST['category'];
    $id = $_POST['id'];
    switch ($category) {
        case "NHL merch":
            $category = "NHL";
            break;
        case "NFL Merchandise":
            $category = "NFL";
            break;
        case "NBA Merch":
            $category = "NBA";
            break;
        case "MLB Merch":
            $category = "MLB";
            break;
        default:
            break;
    }
    $c1 = getKeywordCategory($category);

    if (!empty($c1)) {
        $result = '<select id="keywords-' . $id . '" class="form-control selectpicker" data-live-search="true">';
        foreach ($c1 as $row) {
            $keyword = htmlspecialchars($row['keyword']);
            $volume = htmlspecialchars($row['volume']);
            $result .= "<option value='" . htmlspecialchars($keyword) . "' data-subtext='" . $volume . "'>" . htmlspecialchars($keyword) . "</option>";
        }
        $result .= "</select>";
        echo $result;
    } else {
        $result = '<select id="keywords-' . $id . '" class="form-control selectpicker" data-live-search="true"></select>';
        echo $result;
    }
} else {
    echo "Category parameter not provided.";
}
?>
