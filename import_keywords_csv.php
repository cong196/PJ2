<?php
// Database configuration
$hostname = "localhost";
$username = "root";
$password = "";
$database = "PJ2";

// Create a connection to the database
$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a file was uploaded
if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] === UPLOAD_ERR_OK) {
    $csvFile = $_FILES['csvFile']['tmp_name'];
    $handle = fopen($csvFile, 'r');

    // Read and insert data from the CSV file
    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
        $data = array_map(function($value) use ($conn) {
            return ($value !== null) ? $conn->real_escape_string($value) : null;
        }, $data);
        
        $sql = "INSERT INTO keywords_test (category, keyword, volume, type) 
                VALUES ('" . $data[0] . "', '" . $data[1] . "', '" . $data[2] . "', '" . $data[3] . "')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    fclose($handle);
}

// Close the database connection
$conn->close();
?>
