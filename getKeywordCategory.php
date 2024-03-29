<?php
require __DIR__ . '/vendor/autoload.php';
use Orhanerday\OpenAi\OpenAi;
include "config.php";
include "dbConnect.php";

if(isset($_POST['category'])) {
    // Get the category value from the POST data
    $category = $_POST['category'];
    $id = $_POST['id'];
    $product_type = $_POST['product_type'];
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
        case "St. Patricks Day":
            $category = "St Patricks";
            break;
        default:
            break;
    }
    $c1 = getKeywordCategory($category, $product_type);

    if (!empty($c1)) {
        $result = '<select id="keywords-' . $id . '" class="form-control selectpicker" data-live-search="true">';
        $randomIndex = array_rand($c1);

        /*foreach ($c1 as $row) {
            $keyword = htmlspecialchars($row['keyword']);
            $volume = htmlspecialchars($row['volume']);
            $result .= "<option value='" . $keyword . "' data-subtext='" . $volume . "'>" . $keyword . "</option>";
        }*/

        foreach ($c1 as $index => $row) {
            $keyword = htmlspecialchars($row['keyword']);
            $volume = htmlspecialchars($row['volume']);
            $selected = ($index === $randomIndex) ? ' selected' : '';
            $result .= "<option value='" . $keyword . "' data-subtext='" . $volume . "'" . $selected . ">" . $keyword . "</option>";
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
