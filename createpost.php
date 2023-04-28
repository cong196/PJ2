<?php
    use Automattic\WooCommerce\Client;
    require __DIR__ . '/vendor/autoload.php';
    require_once("wordpress/wp-load.php");
    $content = $_POST['content'];
    $title = $_POST['title'];
    $url = $_POST['urlimg'];
    $urlstore = 'https://themegatee.com';
    $user = 'khajob96';
    $pass = 'vjkdh65734$%#$';
    //$featured_image_id = '';
    $request = wp_remote_post(
            'https://themegatee.com/wp-json/wp/v2/media',
            array(
                'headers' => array(
                    'Authorization' => 'Basic ' . base64_encode('khajob96:vjkdh65734$%#$'),
                    'Content-Disposition' => 'attachment; filename="' . basename( $url ) . '"',
                    'Content-Type: ' . wp_get_image_mime( $url ),
                ),
                'body' => file_get_contents( $url )
            )
        );

        if( 'Created' === wp_remote_retrieve_response_message( $request ) ) {
            $body = json_decode( wp_remote_retrieve_body( $request ) );
            $featured_image_id = $body->id;
            //echo $featured_image_id;
            return $featured_image_id;

            $goodContent = str_replace('\"', '"', $content);
            $api_response = wp_remote_post('https://themegatee.com/wp-json/wp/v2/posts', array(
            'headers' => array(
               'Authorization' => 'Basic ' . base64_encode('khajob96:vjkdh65734$%#$')
            ),
           'body' => array(
                'title'   => $title,
                'status'  => 'publish',
                'content' => $goodContent,
                'featured_media' => $featured_image_id
            )
            ));

           

            $body = json_decode( $api_response['body'] );

            if(wp_remote_retrieve_response_message( $api_response ) === 'Created') {
                    return $body->title->rendered;
                } else {
                    return '0';
                }
        } else {
            return '0';
        }


    /*$goodContent = str_replace('\"', '"', $content);
    $api_response = wp_remote_post('https://themegatee.com/wp-json/wp/v2/posts', array(
    'headers' => array(
       // 'Authorization' => 'Basic ' . base64_encode('USERNAME:PASSWORD')
       'Authorization' => 'Basic ' . base64_encode('khajob96:vjkdh65734$%#$')
    ),
   'body' => array(
        'title'   => $title,
        'status'  => 'publish',
        'content' => $goodContent,
        'featured_media' => $featured_image_id
    )
    ));

   

    $body = json_decode( $api_response['body'] );

    if(wp_remote_retrieve_response_message( $api_response ) === 'Created') {
            return $body->title->rendered;
        } else {
            return '0';
        }*/






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


?>