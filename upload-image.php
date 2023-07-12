<?php
require_once(dirname(__FILE__) . '/wordpress/wp-load.php');

$upload_url = 'https://themegatee.com/wp-json/wp/v2/media';

// Check if a file was submitted
if (isset($_FILES['image_file'])) {
    $image_file = $_FILES['image_file'];

    // Check for errors in the uploaded file
    if ($image_file['error'] === UPLOAD_ERR_OK) {
        // Read the image file
        $image_data = file_get_contents($image_file['tmp_name']);

        // Create the request body
        $body = array(
            'file' => base64_encode($image_data),
        );

        // Set the request headers with Basic authorization
        $username = 'khajob96';
        $password = 'vjkdh65734$%#$';
        $auth_token = base64_encode($username . ':' . $password);
        $headers = array(
            'Authorization' => 'Basic ' . $auth_token,
            'Content-Type' => 'application/json',
        );

        // Send the request using wp_remote_post()
        $response = wp_remote_post($upload_url, array(
            'method' => 'POST',
            'headers' => $headers,
            'body' => json_encode($body),
        ));

        // Check for errors and display the response
        if (!is_wp_error($response) && $response['response']['code'] == 201) {
            $data = json_decode($response['body']);
            $uploaded_url = $data->guid->rendered;
            $uploaded_id = $data->id;
            echo 'Image uploaded successfully. ID: ' . $uploaded_id . '<br>';
            echo 'You can access it using the following URL: ' . $uploaded_url;
        } else {
            $error_message = 'Error uploading the image.';
            if (is_wp_error($response)) {
                $error_message .= ' ' . $response->get_error_message();
            }
            echo $error_message;
        }
    } else {
        echo 'Error uploading the file 2.';
    }
}
?>
