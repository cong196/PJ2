<?php 

	/*require __DIR__ . '/vendor/autoload.php';
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

	var_dump($complete);*/
	
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>HOME PAGE</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" type="text/css" href="/project1/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/project1/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/PJ2/mystyle.css">



<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<style>

.masthead {
  height: 100vh;
  min-height: 500px;
  background-image: url('backgroound1.png');
  background-size: 1000px 1000px;
  background-position: center;
  background-repeat: no-repeat;
  padding-top: 25px;
}

</style>

</head>

<body>
<?php include 'menu.php'; ?>

<!-- Full Page Image Header with Vertically Centered Content -->
<header class="masthead">
  <div class="container h-100">
    <div class="row h-100 align-items-center">
      <div class="col-12 text-center">
      </div>
    </div>
  </div>
</header>


</body>
</html>   