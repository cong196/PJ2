<?php

use Automattic\WooCommerce\Client;
require __DIR__ . '/vendor/autoload.php';
use Orhanerday\OpenAi\OpenAi;



function getTag($title) {
  $open_ai = new OpenAi(getChatGPTKey());
  $prompt_get_tag = 'Based on the product title "'.$title.'" get max 5 category that best match this title. Data return as format "tag1,tag2"';
  $tags_1 = $open_ai->chat([
     'model' => 'gpt-3.5-turbo',
     'messages' => [
         [
             "role" => "assistant",
             "content" => $prompt_get_tag
         ]
     ],
     'temperature' => 1.0,
     'max_tokens' => 2000,
     'frequency_penalty' => 0,
     'presence_penalty' => 0,
      ]);
  $t_tags1 = json_decode($tags_1, true);
  $tags_strings = $t_tags1['choices'][0]['message']['content'];
  return $tags_strings;
}
function getProducts($pg, $perpage,$site, $searchTitle,$sort_by){
  
  $woocommerce = new Client(
        $site->url, 
        $site->ck, 
        $site->cs,
      [
          'version' => 'wc/v3',
      ]
  );
  if($sort_by == 1) {
    $prds = $woocommerce->get('products/?status=draft&orderby=date&order=asc&page='.$pg.'&per_page='.$perpage . '&search='. $searchTitle);
  } else {
    $prds = $woocommerce->get('products/?status=draft&orderby=date&order=desc&page='.$pg.'&per_page='.$perpage . '&search='. $searchTitle);
  }
  //$prds = $woocommerce->get('products/?status=draft&orderby=date&order=asc&page='.$pg.'&per_page='.$perpage . '&search='. $searchTitle);

  $indx = 0;
  while($indx<count($prds)){
      $t = getTag($prds[$indx]->name);
      //$t = preg_replace('/[^a-zA-Z0-9, ]/', '', $t);
      $tagsArray = explode(',', $t);
      $tagData = [];
      foreach ($tagsArray as $tag) {
           $tagData[] = ['name' => trim($tag)];
      }
      $prds[$indx]->tags = $tagData;
      $indx ++;
  }
  return $prds;
};

?>
