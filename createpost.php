<?php
    use Automattic\WooCommerce\Client;
    require __DIR__ . '/vendor/autoload.php';
    require_once("wordpress/wp-load.php");
    $content = $_POST['content'];
    $title = $_POST['title'];

    $url = 'https://www.air-yeezyshoes.com';
    $user = 'hvantoan166@gmail.com';
    $pass = 'jb2CzjxnQE';

    /*$goodContent = str_replace('\"', '"', $content);
    $api_response = wp_remote_post(  $url.'/wp-json/wp/v2/posts', array(
        'headers' => array(
            'Authorization' => 'Basic ' . base64_encode( $user . ':'. $pass )
        ),
        'body' => array(
            'title'   => $title,
            'status'  => 'publish',  
            'content' => $content
        )
    ) );
    if( wp_remote_retrieve_response_message( $api_response ) === 'Created' ) {
        echo $body->title->rendered;
    } else {
        echo '0';
    }*/


    echo '324234234';
?>