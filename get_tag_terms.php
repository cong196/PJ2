<?php
    include "dbConnect.php";
    $tagTermsList = get_tags_terms_2();
    $result = "";
    if (empty($tagTermsList)) {
        $result .= '<div class="alert alert-info">No tag terms found.</div>';
    } else {
        foreach ($tagTermsList as $tagTerm) {
            $result .= '<span class="tag-term">' . htmlspecialchars($tagTerm) . '</span> '; // Using span as inline-block element
        }
    }

    echo $result;

?>
