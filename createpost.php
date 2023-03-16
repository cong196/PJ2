<?php
    use Automattic\WooCommerce\Client;
    require __DIR__ . '/vendor/autoload.php';
    require_once("wordpress/wp-load.php");
    $content = $_POST['content'];
    $title = $_POST['title'];

    $url = 'https://themegatee.com';
    $user = 'khajob96';
    $pass = 'vjkdh65734$%#$';


    $goodContent = str_replace('\"', '"', $content);
    $api_response = wp_remote_post('https://themegatee.com/wp-json/wp/v2/posts', array(
    'headers' => array(
       // 'Authorization' => 'Basic ' . base64_encode('USERNAME:PASSWORD')
       'Authorization' => 'Basic ' . base64_encode('khajob96:vjkdh65734$%#$')
    ),
   'body' => array(
        'title'   => $title,
        'status'  => 'publish',
        'content' => $goodContent
    )
));

   /* $api_response = wp_remote_post('https://themegatee.com/wp-json/wp/v2/posts', array(
    'headers' => array(
       // 'Authorization' => 'Basic ' . base64_encode('USERNAME:PASSWORD')
       'Authorization' => 'Basic ' . base64_encode('khajob96:vjkdh65734$%#$')
    ),
   'body' => array(
        'title'   => $title,
        'status'  => 'publish', // We do not want to publish it immediately
        'content' => $content,
        'categories' => 16, // category ID
        'tags' => '2,3,6', // comma separated
        'date' => '2022-07-22T10:00:00', // YYYY-MM-DDTHH:MM:SS
        'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'password' => '123456',
        'slug' => 'lorem-ipsum-dolor-sit-amet'
    )
));*/

$body = json_decode( $api_response['body'] );

if(wp_remote_retrieve_response_message( $api_response ) === 'Created') {
        /*$return = array(
            'message'  => 'The post ' . $body->title->rendered . ' has been created successfully',
        );
        return wp_send_json($return, 200);*/
        return $body->title->rendered;
    } else {
        return '0';
    }
?>