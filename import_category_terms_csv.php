<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "PJ2";

    // Create a connection to the database
    $conn = new mysqli($hostname, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] === UPLOAD_ERR_OK) {
        $csvFile = $_FILES['csvFile']['tmp_name'];
        

        $handle = fopen($csvFile, 'r');
        if ($handle === FALSE) {
            echo "Error: Không đọc được file ...";
            exit;
        }

        $conn->begin_transaction();

        /*while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $stmt = $conn->prepare("INSERT INTO category_term (category, term) VALUES (?, ?)");
            if ($stmt === FALSE) {
            }

            $stmt->bind_param("ss", $data[0], $data[1]);

            if (!$stmt->execute()) {
                echo "Error: " . $stmt->error;
                $conn->rollback(); // Rollback the transaction on error
                return; // Exit the script or handle the error appropriately
            }
        }*/

        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // Check if the record already exists
            $checkStmt = $conn->prepare("SELECT COUNT(*) FROM category_term WHERE category = ? AND term = ?");
            $checkStmt->bind_param("ss", $data[0], $data[1]);
            $checkStmt->execute();
            $checkStmt->bind_result($count);
            $checkStmt->fetch();
            $checkStmt->close();

            if ($count == 0) {
                // Insert the record if it doesn't exist
                $stmt = $conn->prepare("INSERT INTO category_term (category, term) VALUES (?, ?)");
                if ($stmt === FALSE) {
                    echo "Error: Unable to prepare statement.";
                    exit;
                }

                $stmt->bind_param("ss", $data[0], $data[1]);

                if (!$stmt->execute()) {
                    echo "Error: " . $stmt->error;
                    // Decide if you want to rollback for other kinds of errors
                }

                $stmt->close();
            }
        }

        $conn->commit(); // Commit the transaction
        fclose($handle);
        echo "Thành công: File CSV đã được xử lý và dữ liệu đã được chèn vào cơ sở dữ liệu.";
    } else {
        echo "Lỗi: Tải lên tệp không thành công với mã lỗi " . $_FILES['csvFile']['error'];;
    }

    // Close the database connection
    $conn->close();
?>
