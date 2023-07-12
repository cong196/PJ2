<?php
    use Automattic\WooCommerce\Client;
    require __DIR__ . '/vendor/autoload.php';
    require_once("wordpress/wp-load.php");
    $content = $_POST['content'];
    $title = $_POST['title'];
    $url = $_POST['urlimg'];
    $imageId = $_POST['imageId'];
    $selectPostCategory = $_POST['selectPostCategory'];
    $urlstore = 'https://themegatee.com';
    $user = 'khajob96';
    $pass = 'vjkdh65734$%#$';

    $categories = explode(',', $selectPostCategory);
    $categories = array_map('trim', $categories);

    //$featured_image_id = '';
    //echo $categories;
    if($imageId != '000') { // up anh tu may tinh
        $goodContent = str_replace('\"', '"', $content);
        $api_response = wp_remote_post('https://themegatee.com/wp-json/wp/v2/posts', array(
        'headers' => array(
            'Authorization' => 'Basic ' . base64_encode('khajob96:vjkdh65734$%#$')
        ),
        'body' => array(
            'title'   => $title,
            'status'  => 'publish',
            'content' => $goodContent,
            'featured_media' => $imageId,
            'categories' => $categories
        )
        ));
        $body = json_decode( $api_response['body'] );
        if(wp_remote_retrieve_response_message( $api_response ) === 'Created') {
                echo '1';
        } else {
                echo '0';
        }
    } else {
        if($url != ''){ // up anh bang url
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
            if(wp_remote_retrieve_response_message( $request ) == 'Created' ) {
                $body = json_decode( wp_remote_retrieve_body($request) );
                $featured_image_id = $body->id;
                //echo $featured_image_id;
                //return $featured_image_id;

                $goodContent = str_replace('\"', '"', $content);
                $api_response = wp_remote_post('https://themegatee.com/wp-json/wp/v2/posts', array(
                'headers' => array(
                    'Authorization' => 'Basic ' . base64_encode('khajob96:vjkdh65734$%#$')
                ),
                'body' => array(
                    'title'   => $title,
                    'status'  => 'publish',
                    'content' => $goodContent,
                    'featured_media' => $featured_image_id,
                    'categories' => $categories
                )
                ));
                $body = json_decode( $api_response['body'] );
                if(wp_remote_retrieve_response_message( $api_response ) === 'Created') {
                        echo '1';
                } else {
                        echo '0';
                }
            } else {
                return '0';
            }
        } else { // khong dung anh
            $goodContent = str_replace('\"', '"', $content);
                $api_response = wp_remote_post('https://themegatee.com/wp-json/wp/v2/posts', array(
                'headers' => array(
                    'Authorization' => 'Basic ' . base64_encode('khajob96:vjkdh65734$%#$')
                ),
                'body' => array(
                    'title'   => $title,
                    'status'  => 'publish',
                    'content' => $goodContent,
                    'categories' => $categories
                )
                ));
                $body = json_decode( $api_response['body'] );
                if(wp_remote_retrieve_response_message( $api_response ) === 'Created') {
                    echo '1';
                } else {
                    echo '0';
                }
        }
    }
?>