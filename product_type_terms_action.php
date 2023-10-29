<?php
    include "dbConnect.php";
    //$response = ['success' => false, 'message' => 'Unknown error'];
    if(isset($_POST['action'])) {
        $action = $_POST['action'];
        switch($action) {
            case 'add':
                $text = $_POST['text'];
                $type = $_POST['type'];

                $data = add_product_type_terms($text,$type);
                if($data == "1") {
                    $response = ['success' => true, 'data' => $data];
                } else {
                    $response = ['success' => false, 'data' => $data];
                }
                break;

            case 'edit':
                // TODO: Edit logic here
                break;

            case 'delete':
                $text = $_POST['text'];
                $data = delete_product_type_terms($text);
                if($data == "1") {
                    $response = ['success' => true, 'data' => $data];
                } else {
                    $response = ['success' => false, 'data' => $data];
                }
                break;
            case 'fetch':
                $titleClassifier = get_product_type_terms();
                $data = [];
                foreach ($titleClassifier['categories'] as $text => $type) {
                    $data[] = [
                        'text' => $text,
                        'type' => $type
                    ];
                }
                $response = ['success' => true, 'data' => $data];
                break;
        }
    }
    echo json_encode($response);
    
?>
