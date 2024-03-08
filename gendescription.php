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
$ispublic = $_POST['ispublic'];
$isaddtoschedule = $_POST['isaddtoschedule'];
$is_add_related = $_POST['is_add_related'];
$is_add_homepage = $_POST['is_add_homepage'];
$id = $_POST['id'];
$prompt = '';

$randNum = rand(1, 100);

if ($randNum <= 50) {
    $edtKeyword = "";
} else {
    
}
    

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
            if($storedValueModel == 3) {
                $api_key = getGoogleGeminiAPI();
                $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . $api_key;
                $data = array(
                    "contents" => array(
                        array(
                            "parts" => array(
                                array(
                                    "text" => $prompt
                                )
                            )
                        )
                    ),
                    "generationConfig" => array(
                        "temperature" => 0.9,
                        "topK" => 1,
                        "topP" => 1,
                        "maxOutputTokens" => 2048,
                        "stopSequences" => array()
                    ),
                    "safetySettings" => array(
                        array("category" => "HARM_CATEGORY_HARASSMENT", "threshold" => "BLOCK_MEDIUM_AND_ABOVE"),
                        array("category" => "HARM_CATEGORY_HATE_SPEECH", "threshold" => "BLOCK_MEDIUM_AND_ABOVE"),
                        array("category" => "HARM_CATEGORY_SEXUALLY_EXPLICIT", "threshold" => "BLOCK_MEDIUM_AND_ABOVE"),
                        array("category" => "HARM_CATEGORY_DANGEROUS_CONTENT", "threshold" => "BLOCK_MEDIUM_AND_ABOVE")
                    )
                );

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

                $response = curl_exec($ch);
                if (!$response) {
                    die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
                }
                curl_close($ch);

                $responseArray = json_decode($response, true); // decode as associative array

                if (isset($responseArray['candidates']) && count($responseArray['candidates']) > 0) {
                    $text = $responseArray['candidates'][0]['content']['parts'][0]['text'];
                    $rs = $text;
                } else {
                    $rs = $title;
                }
            } else {

            }
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
            if($storedValueModel == 3) {
                $api_key = getGoogleGeminiAPI();
                $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . $api_key;
                $data = array(
                    "contents" => array(
                        array(
                            "parts" => array(
                                array(
                                    "text" => $prompt2
                                )
                            )
                        )
                    ),
                    "generationConfig" => array(
                        "temperature" => 0.9,
                        "topK" => 1,
                        "topP" => 1,
                        "maxOutputTokens" => 2048,
                        "stopSequences" => array()
                    ),
                    "safetySettings" => array(
                        array("category" => "HARM_CATEGORY_HARASSMENT", "threshold" => "BLOCK_MEDIUM_AND_ABOVE"),
                        array("category" => "HARM_CATEGORY_HATE_SPEECH", "threshold" => "BLOCK_MEDIUM_AND_ABOVE"),
                        array("category" => "HARM_CATEGORY_SEXUALLY_EXPLICIT", "threshold" => "BLOCK_MEDIUM_AND_ABOVE"),
                        array("category" => "HARM_CATEGORY_DANGEROUS_CONTENT", "threshold" => "BLOCK_MEDIUM_AND_ABOVE")
                    )
                );

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

                $response = curl_exec($ch);
                if (!$response) {
                    die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
                }
                curl_close($ch);

                $responseArray = json_decode($response, true); // decode as associative array

                if (isset($responseArray['candidates']) && count($responseArray['candidates']) > 0) {
                    $text2 = $responseArray['candidates'][0]['content']['parts'][0]['text'];
                    $rs3 = $text2;
                } else {
                    $rs3 = $title;
                }
            } else {

            }
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

        if($is_add_related == 1) {
            $c1 = getclosingParagraph();
            $closingContent = $c1["content"];
            $linkrelated = getRandomRelatedProduct($curPageName,$selectmainCategory,$edttitle);
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
    
    if($is_add_homepage == 1) {
        if($curPageName == 'themega-editdraftproduct.php') {

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
            $closingContent = $closingContent ."<p>".$result4."</p>";
        } else {
            if($curPageName == 'customjoygifts-editdraftproduct.php') {
                $complete33 = $open_ai->chat([
                   'model' => 'gpt-3.5-turbo',
                   'messages' => [
                       [
                           "role" => "assistant",
                           "content" => 'Write a short ending thanking the customer at the bottom of the product page and insert 1 my homepage url in an anchor text. Where to insert links please add the following format so I can recognize [anchor:anchor text]. My url is: https://customjoygifts.com, my store name is Customjoygifts.'
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
                    return '<b><a href="https://customjoygifts.com">' . $matches[1] . '</a></b>';
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
                $closingContent = $closingContent ."<p>".$result4."</p>";
            } else {
                if($curPageName == 'printfusionusa-editdraftproduct.php') {
                    $complete33 = $open_ai->chat([
                       'model' => 'gpt-3.5-turbo',
                       'messages' => [
                           [
                               "role" => "assistant",
                               "content" => 'Write a short ending thanking the customer at the bottom of the product page and insert 1 my homepage url in an anchor text. Where to insert links please add the following format so I can recognize [anchor:anchor text]. My url is: https://printfusionusa.com, my store name is Printfusionusa.'
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
                        return '<b><a href="https://printfusionusa.com">' . $matches[1] . '</a></b>';
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
                    $closingContent = $closingContent ."<p>".$result4."</p>";
                }
            }
        }
    }

    if($isaddtoschedule && $ispublic == 0) {
        addScheduleProduct($id,$curPageName);
    }
    echo '<h2>'.$result3. '</h2> <p>'. $result .'</p>BD0011'. $closingContent;

?>