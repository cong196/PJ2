<?php
include 'dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tagTerm = $_POST["tagTerm"];
    
    echo insert_tags_terms_to_database($tagTerm);
}
?>
