<?php 
    include "dbConnect.php";
    $title = $_POST['title'];
    $title = 'sdfsdf ' . $title;
    $title_without_quotes = str_replace("'", "", $title);
    $replacedString = str_replace(", ", ",", findCategoriesInTitle($title));
    echo $replacedString;
?>