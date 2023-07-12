<?php 
	
	require __DIR__ . '/vendor/autoload.php';
	use Orhanerday\OpenAi\OpenAi;
	include "config.php";
	include "dbConnect.php";
	$title =  $_POST['title'];
	$kwintro = $_POST['kwintro'];
	$keywordcategory = $_POST['keywordcategory'];
	$curPageName = $_POST['curPageName'];
	$prompt = '';
	if($kwintro == '') {
		$prompt = 'make short intro about 50 to 100 words for following title : '. $title;
	} else {
		$prompt = 'make short intro about 50 to 100 words for following title : '. $title . '. Make paragraph contain "'.$kwintro;
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

	$linkkw = getlinkCategory($curPageName,$keywordcategory);
	
	// Chèn link category
    if($linkkw != ''){
        $insLink = "<strong><a href=". $linkkw ." style=\"color:#0969da\">". $kwintro . "</a></strong>";

        $tempResult = strtolower($result);
        $tempKeyword = strtolower($kwintro);

        $position = strrpos($tempResult, $tempKeyword);

        if ($position !== false) {
            $result = substr_replace($result, $insLink, $position, strlen($kwintro));
        }
    }

	echo $result;

?>