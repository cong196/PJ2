<?php 
    include "dbConnect.php";
    $title = $_POST['title'];
    $title = 'sdfsdf ' . $title;
    $replacedString = str_replace(", ", ",", findCategoriesInTitle($title));
    echo $replacedString;
?>