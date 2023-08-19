<?php
require __DIR__ . '/vendor/autoload.php';
use Orhanerday\OpenAi\OpenAi;
include "config.php";
include "dbConnect.php";

if(isset($_POST['valCategory'])) {
    $site = $_POST['site'];
    $id = $_POST['valCategory'];
    
    $c1 = getlinkCategory($site,$id);

    if (!empty($c1)) {
        echo $c1;
    } else {
        
        echo "URL not found !!";
    }
} else {
    echo "URL not found !!";
}
?>
