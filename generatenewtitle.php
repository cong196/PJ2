<?php 

$title =  $_POST['title'];
$sites =  $_POST['site'];
$prompt = 'make another title for following title : '. $title;
	require __DIR__ . '/vendor/autoload.php';
	use Orhanerday\OpenAi\OpenAi;
	include "config.php";
	$open_ai = new OpenAi(getChatGPTKey());
	// get prompt parameter
	//$prompt = $_GET['prompt'];
	// set api data
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
	echo $result;

?>