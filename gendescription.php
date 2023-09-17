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
$storedValueModel = $_POST['storedValueModel'];
$storedValue = $_POST['storedValue'];

$prompt = '';
if($customprompt == '') {
    if($edtKeyword == ''){
        $prompt = 'write a describe about : '. $title .'. Make paragraph have least at '.$storedValue.' words and dont include "'. $title .'"';
    } else {
        $prompt = 'write a describe about : '. $title .', focus to design. make paragraph contain "'.$edtKeyword.'" word and have least at '.$storedValue.' words and dont include "'. $title .'"';
    }
    
} else {
    if($edtKeyword == ''){
        $prompt = $customprompt;
    } else {
        $prompt = $customprompt . '. Make paragraph contain "'.$edtKeyword.'" word and have least at '.$storedValue.' words';
    }
}
    $open_ai = new OpenAi(getChatGPTKey());
    $rs = "";

    if($storedValueModel == 1) {
        $complete = $open_ai->completion([
            'model' => 'text-davinci-003',
            'prompt' => $prompt,
            'temperature' => 1,
            'max_tokens' => 1250,
            'top_p' => 1,
            'frequency_penalty' => 0,
            'presence_penalty' => 0
        ]);

        $rs1 = json_decode($complete, true);
        $rs = $rs1['choices'][0]['text'];
    } else{
        if ($storedValueModel == 2) {
        $complete = $open_ai->chat([
           'model' => 'gpt-3.5-turbo',
           'messages' => [
               [
                   "role" => "assistant",
                   "content" => $prompt
               ]
           ],
           'temperature' => 1.0,
           'max_tokens' => 2000,
           'frequency_penalty' => 0,
           'presence_penalty' => 0,
            ]);
        $rs1 = json_decode($complete, true);
        $rs = $rs1['choices'][0]['message']['content'];
        } else {

        }
    }

    $result1 = trim($rs);
    $result = str_replace("\"","",$result1);
    $prompt2 = 'make a title for this content: ' . $result;
    $open_ai2 = new OpenAi(getChatGPTKey());

    $rs3 = "";
    if($storedValueModel == 1) {
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

    } else{
        if ($storedValueModel == 2) {
        $complete2 = $open_ai->chat([
           'model' => 'gpt-3.5-turbo',
           'messages' => [
               [
                   "role" => "assistant",
                   "content" => $prompt2
               ]
           ],
           'temperature' => 1.0,
           'max_tokens' => 1000,
           'frequency_penalty' => 0,
           'presence_penalty' => 0,
            ]);
        $rsg = json_decode($complete2, true);
        $rs3 = $rsg['choices'][0]['message']['content'];

        } else {

        }
    }

    
    
    $result3 = trim($rs3);
    $result3 = str_replace("\"","",$result3);

    $linkkw = '';
    $linkrelated = [];

    $closingContent = '';

    if($selectmainCategory !== ''){
        if($edtKeyword !== '') {
            // link category chen vao keyword
            $linkkw = getlinkCategory($curPageName,$selectmainCategory);
        }
        $c1 = getclosingParagraph();
        $closingContent = $c1["content"];
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
    
    
    $complete33 = $open_ai->chat([
       'model' => 'gpt-3.5-turbo',
       'messages' => [
           [
               "role" => "assistant",
               "content" => 'Write a short ending thanking the customer at the bottom of the product page and insert 1 my homepage url in an anchor text. Where to insert links please add the following format so I can recognize [anchor:anchor text]. My url is: https://themegatee.com, my store name is Themegatee.'
           ]
       ],
       'temperature' => 1.0,
       'max_tokens' => 1000,
       'frequency_penalty' => 0,
       'presence_penalty' => 0,
        ]);
        $rsg3 = json_decode($complete33, true);
        $rs333 = $rsg3['choices'][0]['message']['content'];
    
    $pattern = '/\[anchor:(.*?)\]/';
    
    $newText = preg_replace_callback($pattern, function($matches) {
        return '<b><a href="https://themegatee.com">' . $matches[1] . '</a></b>';
    }, $rs333);

    $pattern2 = '/<a\s+(?:[^>]*?\s+)?href=([\'"])(.*?)\1[^>]*>(.*?)<\/a>/i';
    $counter = 0;
    $result4 = preg_replace_callback($pattern2, function($match) use (&$counter) {
        if ($counter == 0) {
            $counter++;
            return $match[0];
        } else {
            return $match[3];
        }
    }, $newText);
    
    
    //$close2 = getClosing($curPageName);
    $closingContent = $closingContent ."<p>".$newText."</p>";

    echo '<h2>'.$result3. '</h2> <p>'. $result .'</p>BD0011'. $closingContent;

?>