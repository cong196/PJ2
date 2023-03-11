<?php 

	require __DIR__ . '/vendor/autoload.php';
	use Orhanerday\OpenAi\OpenAi;
	$open_ai = new OpenAi('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');
	// get prompt parameter
	$prompt = $_GET['prompt'];
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

	var_dump($complete);
	/*var_dump($prompt);
	echo $prompt;*/
?>