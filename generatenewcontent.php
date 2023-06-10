<?php 

$title2 =  $_POST['title'];
$prompt2 = 'Write a paragraph with the following content: '. $title2;
	require __DIR__ . '/vendor/autoload.php';
	use Orhanerday\OpenAi\OpenAi;
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

	
	$rs21 = json_decode($complete2, true);
	$rs2 = $rs21['choices'][0]['text'];
	$result2 = trim($rs2);
	$result2 = str_replace("\"","",$result2);
	echo $result2;

	//echo "1";

?>