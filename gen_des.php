<?php
    use Automattic\WooCommerce\Client;
    require __DIR__ . '/vendor/autoload.php';
    use Orhanerday\OpenAi\OpenAi;
    include "config.php";
    include "dbConnect.php";
    $title =  $_POST['title'];
    $page_name = $_POST['page_name'];
    $model_GPT = $_POST['model_GPT'];
    $minimum_words = $_POST['minimum_words'];
    $tags = $_POST['tags'];
    $prompt = "";
    
    $is_insert_related_product = $_POST['is_add_related'];
    $is_insert_homepage = $_POST['is_add_homepage'];

    function getContentOpenAI($prompt,$model) {
        $open_ai = new OpenAi(getChatGPTKey());
        if($model == 1) {
                $tags_1 = $open_ai->completion([
                'model' => 'text-davinci-003',
                'prompt' => $prompt,
                'temperature' => 1,
                'max_tokens' => 2000,
                'top_p' => 1,
                'frequency_penalty' => 0,
                'presence_penalty' => 0
            ]);

            $t_tags1 = json_decode($tags_1, true);
            $tags_strings = $t_tags1['choices'][0]['text'];
            return $tags_strings;
        } else {
            $tags_1 = $open_ai->chat([
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
            $t_tags1 = json_decode($tags_1, true);
            $tags_strings = $t_tags1['choices'][0]['message']['content'];
            return $tags_strings;
        }
    }


    function insert_tag_to_store($t,$p) {
        $site = json_decode(getKey($p));

        $data = [
            'name' => strtolower($t)
        ];

        $woocommerce = new Client(
        $site->url, 
        $site->ck,
        $site->cs,
            [
                'version' => 'wc/v3',
            ]
        );

        $tagName = $data['name'];
        $allTags = $woocommerce->get('products/tags');
        $tagExists = false;
        foreach ($allTags as $tag) {
            if (strtolower($tag->name) === strtolower($tagName)) {
                $tagExists = true;
                break;
            }
        }
        
        if (!empty($tagExists)) {
            return "0";
        }
        $response = $woocommerce->post('products/tags', $data);
        return $response;
    }

    if($tags == '') {
        $prompt = 'i have title product: "'.$title.'", write a describe about this product. Make paragraph have least at '.$minimum_words.' words and dont include "'. $title .'" in content.';
        $description = getContentOpenAI($prompt,$model_GPT);
        if($is_insert_related_product == 1) {

        }
        if($is_insert_homepage == 1) {

        }

        echo $description;

    } else {
        $tagsArray = explode(",", $tags);
    
        foreach ($tagsArray as $tag) {
            if(check_tags_exist($tag, $page_name) == 2){
                $data = insert_tag_to_store($tag, $page_name);
                if($data === "0") {

                } else {
                    //$response = json_decode($data, true);
                    updateTag($page_name,$data->id,$data->name,$data->slug);
                }

            }

        }

        $tag0 = $tagsArray[0];
        $prompt = 'i have title product: "'.$title.'", and tag "'.$tag0.'", please generate 1 SEO keyword for this tag. Only return keyword and dont include anything elese';
        $keyword = getContentOpenAI($prompt,$model_GPT);
        $keyword = str_replace('"', '', $keyword);

        $prompt2 = 'i have title product: "'.$title.'", write a describe about this product with SEO keyword is "'.$keyword.'". Make paragraph have least at '.$minimum_words.' words and containt SEO keyword and dont include "'. $title .'" in content.'; 
        $description = getContentOpenAI($prompt2,$model_GPT);

        $url_tag = get_link_tag($tag0,$page_name);

        $insLink = "<strong><a href=". $url_tag .">". $keyword . "</a></strong>";

        $tempResult = strtolower($description);
        $tempKeyword = strtolower($keyword);

        $position = strrpos($tempResult, $tempKeyword);
        if ($position !== false) {
            $description = substr_replace($description, $insLink, $position, strlen($keyword));
        }

        $description = $description . 'BD0011';
        if($is_insert_related_product == 1) {

            $random_related_product = get_related_product($page_name,$tag0);
            if ($random_related_product !== 0) {

                $slug = $random_related_product['slug'];

                $prompt3 = 'I\'m writing a description for a product titled "'.$title.'", I have a related product titled "'.$random_related_product['name'].'", which serves as home ad, write a Conclusion paragraph for customers to click on the link of the related product in a natural and SEO-friendly way, do not include the word "Conclusion" and custom product title for the most natural. Where place link to related product plese use this format [title:name of related product] so that I can identify it and make it easy to use';

                $related = getContentOpenAI($prompt3,$model_GPT);

                $result = preg_replace_callback(
                    '/\[(.*?):(.*?)\]/', 
                    function($matches) use ($slug) {
                        $text = trim($matches[2]);
                        return "<b><a href='{$slug}'>{$text}</a></b>";
                    }, 
                    $related
                );
                $description = $description . '<p>' . $result . '</p>';
            }
        }
        if($is_insert_homepage == 1) {
            $prompt_home_page = '';
            if($page_name == 'kacogifts-editdraftproduct.php') {
                $prompt_home_page = 'Write a short ending thanking the customer at the bottom of the product page and insert 1 my homepage url in an anchor text. Where to insert links please add the following format so I can recognize [anchor:anchor text]. My url is: http://kacogifts.com, my store name is Kacogifts.';
            } else {

            }

            if($prompt_home_page !== '') {
                $end_home_page = getContentOpenAI($prompt_home_page,$model_GPT);
                $pattern = '/\[anchor:(.*?)\]/';

                if($page_name == 'kacogifts-editdraftproduct.php') {
                   $new_end_home_page = preg_replace_callback($pattern, function($matches) {
                    return '<b><a href="https://kacogifts.com">' . $matches[1] . '</a></b>';
                }, $end_home_page);
                }
                /*$new_end_home_page = preg_replace_callback($pattern, function($matches) {
                    return '<b><a href="https://themegatee.com">' . $matches[1] . '</a></b>';
                }, $end_home_page);*/

                $pattern2 = '/<a\s+(?:[^>]*?\s+)?href=([\'"])(.*?)\1[^>]*>(.*?)<\/a>/i';
                $counter = 0;
                $new_end_home_page_2 = preg_replace_callback($pattern2, function($match) use (&$counter) {
                    if ($counter == 0) {
                        $counter++;
                        return $match[0];
                    } else {
                        return $match[3];
                    }
                }, $new_end_home_page);

                $description = $description . '<p>' . $new_end_home_page_2 . '</p>';
            }
        }

        echo $description;
    }
    //$prompt = 'write a describe about : '. $title .'. Make paragraph have least at '.$minimum_words.' words and dont include "'. $title .'"';

?>