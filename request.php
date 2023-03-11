<?php 

	$my_apikey = "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";
	require __DIR__ . '/vendor/autoload.php';
	use Orhanerday\OpenAi\OpenAi;
	$open_ai = new OpenAi('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');
	$prompt = $_GET['prompt'];
	/*$complete = $open_ai->completion(
	    // parameter object here
	, function($curl_info, $data){
	    // response here
	});*/

	$rs = $open_ai->completion([
		'model' => 'text-davinci-003',
		'promt' => $prompt,
		 'temperature' => 0.7,
		 'top_p'=> 1,
		 'max_tokens' => 300,
		 'frequency_penalty' => 0,
		 'presence_penalty' => 0,
		 'stream' => true

	]);

	echo $rs;
?>