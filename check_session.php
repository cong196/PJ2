<?php
// Start the session
session_start();

// Check if the session variable exists and its value
if (isset($_SESSION['PJ2_loggedin']) && $_SESSION['PJ2_loggedin'] === true) {
    // User is logged in
    $response = array('logged_in' => true);
} else {
    // User is not logged in
    $response = array('logged_in' => false);
}

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
