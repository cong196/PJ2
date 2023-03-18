<?php 
	use Automattic\WooCommerce\Client;
    require __DIR__ . '/vendor/autoload.php';
    require_once("wordpress/wp-load.php");
		$url = $_POST['url'];
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
		} else {
			return '0';
		}

?>