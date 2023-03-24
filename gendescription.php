<?php 
require __DIR__ . '/vendor/autoload.php';
use Orhanerday\OpenAi\OpenAi;
$title =  $_POST['title'];
$customprompt =  $_POST['prompt'];
//echo $customprompt;
$prompt = '';
if($customprompt == '') {
    $prompt = 'write a describe about : '. $title;
} else {
    $prompt = $customprompt;
}
    $open_ai = new OpenAi('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');
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
    $open_ai2 = new OpenAi('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');
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

    echo '<h2>'.$result3. '</h2> <p>'. $result .'</p>';
?>