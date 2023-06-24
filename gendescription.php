<?php 
require __DIR__ . '/vendor/autoload.php';
use Orhanerday\OpenAi\OpenAi;
include "config.php";
include "dbConnect.php";
$title =  $_POST['title'];
$customprompt =  $_POST['prompt'];
$edtKeyword = $_POST['edtKeyword'];
$selectmainCategory = $_POST['selectmainCategory'];
$curPageName = $_POST['curPageName'];
$edttitle = $_POST['edttitle'];
//echo $customprompt;
$prompt = '';
if($customprompt == '') {
    if($edtKeyword == ''){
        $prompt = 'write a describe about : '. $title;
    } else {
        $prompt = 'write a describe about : '. $title .', focus to design. make paragraph contain "'.$edtKeyword.'" word and have least at 50 words';
    }
    
} else {
    if($edtKeyword == ''){
        $prompt = $customprompt;
    } else {
        $prompt = $customprompt . '. Make paragraph contain "'.$edtKeyword.'" word and have least at 50 words';
    }
}
    $open_ai = new OpenAi(getChatGPTKey());
    $complete = $open_ai->completion([
        'model' => 'text-davinci-003',
        'prompt' => $prompt,
        'temperature' => 1,
        'max_tokens' => 1050,
        'top_p' => 1,
        'frequency_penalty' => 0,
        'presence_penalty' => 0
    ]);

    
    $rs1 = json_decode($complete, true);
    $rs = $rs1['choices'][0]['text'];
    $result1 = trim($rs);
    $result = str_replace("\"","",$result1);
    $prompt2 = 'make a title for this content: ' . $result;
    $open_ai2 = new OpenAi(getChatGPTKey());
    $complete2 = $open_ai2->completion([
        'model' => 'text-davinci-003',
        'prompt' => $prompt2,
        'temperature' => 1,
        'max_tokens' => 1050,
        'top_p' => 1,
        'frequency_penalty' => 0,
        'presence_penalty' => 0
    ]);

    $rsg = json_decode($complete2, true);
    $rs3 = $rsg['choices'][0]['text'];
    $result3 = trim($rs3);
    $result3 = str_replace("\"","",$result3);

    $linkkw = '';
    $linkrelated = [];

    $closingContent = '';

    if($edtKeyword !== '' && $selectmainCategory !== ''){

        $c1 = getclosingParagraph();
        $closingContent = $c1["content"];

        // link category chen vao keyword
        $linkkw = getlinkCategory($curPageName,$selectmainCategory);

        //link sp cung category.
        $linkrelated = getRandomRelatedProduct($curPageName,$selectmainCategory,$edttitle);
        //$czzzzz = $linkkw["slug"];
        //echo $link;
        if($linkrelated != 0) {
            $insLink = "<strong><a href=". $linkrelated["slug"] .">". $linkrelated["name"] . "</a></strong>";
            $position = strrpos($closingContent, 'ProductB');
            if ($position !== false) {
                $closingContent = substr_replace($closingContent, $insLink, $position, strlen('ProductB'));
            }
        } else {
            $closingContent = '';
        }
    }

    // Chèn link category
    if($linkkw != ''){
        $insLink = "<strong><a href=". $linkkw ." style=\"color:#0969da\">". $edtKeyword . "</a></strong>";

        $tempResult = strtolower($result);
        $tempKeyword = strtolower($edtKeyword);

        $position = strrpos($tempResult, $tempKeyword);

        if ($position !== false) {
            $result = substr_replace($result, $insLink, $position, strlen($edtKeyword));
        }
    }

    $close2 = getClosing($curPageName);
    $closingContent = $closingContent ."<p>".$close2."</p>";

    echo '<h2>'.$result3. '</h2> <p>'. $result .'</p>BD0011'. $closingContent;

?>