<?php
function getdataCategory($site){
      /*  $conn = mysqli_connect('localhost', 'root', '');*/
        $dbh = mysqli_connect('localhost', 'root', ''); 
            // Kết nối tới MySQL server
        if (!$dbh){
            die("Unable to connect to MySQL: " . mysqli_error());
            // Nếu kết nối thất bại thì đưa ra thông báo lỗi
        } else {
            if (!mysqli_select_db($dbh,'PJ2')){
                die("Unable to select database: " . mysqli_error());
                // Thông báo lỗi nếu chọn CSDL thất bại
            } else {
                if($site == 'themegatee' || $site == 'themegatee-editproducts.php' || $site == 'themega-editdraftproduct.php') {
                    $sql_stmt = "SELECT * FROM themegatee_category"; 
                    // Câu lệnh select
                    $result = mysqli_query($dbh,$sql_stmt);
                    $rows = mysqli_num_rows($result); 
                     // Lấy số hàng trả về
                    $responseCategory = array();
                    if ($rows) {
                        while ($row = mysqli_fetch_array($result)) {         
                            /*echo 'ID: ' . $row['id'] . '<br>';         
                            echo 'Full Names: ' . $row['name'] . '<br>';        
                            echo 'slug: ' . $row['slug'] . '<br>';   */
                            $responseCategory [] = array(
                                'id' => $row['id'],
                                'name' => $row['name'],
                                'slug' => $row['slug']
                            );
                        } 
                    }
                    //$resultF = array();
                    //$resultF['data'] = $responseCategory;
                    //$resultF['num'] = $rows;
                    mysqli_close($dbh); // Đóng kết nối CSDL
                    return json_encode($responseCategory);
            }
            mysqli_close($dbh); // Đóng kết nối CSDL
        }
        //mysqli_close($dbh); // Đóng kết nối CSDL
    }
}


function getdataTag($site){
      /*  $conn = mysqli_connect('localhost', 'root', '');*/
        $dbh = mysqli_connect('localhost', 'root', ''); 
            // Kết nối tới MySQL server
        if (!$dbh){
            die("Unable to connect to MySQL: " . mysqli_error());
            // Nếu kết nối thất bại thì đưa ra thông báo lỗi
        } else {
            if (!mysqli_select_db($dbh,'PJ2')){
                die("Unable to select database: " . mysqli_error());
                // Thông báo lỗi nếu chọn CSDL thất bại
            } else {
                if($site == 'themegatee' || $site == 'themegatee-editproducts.php' || $site == 'themega-editdraftproduct.php') {
                    $sql_stmt = "SELECT * FROM themegatee_tag"; 
                    // Câu lệnh select
                    $result = mysqli_query($dbh,$sql_stmt);
                    $rows = mysqli_num_rows($result); 
                     // Lấy số hàng trả về
                    $responseCategory = array();
                    if ($rows) {
                        while ($row = mysqli_fetch_array($result)) {
                            $responseCategory [] = array(
                                'id' => $row['id'],
                                'name' => $row['name'],
                                'slug' => $row['slug']
                            );
                        } 
                    }
                    //$resultF = array();
                    //$resultF['data'] = $responseCategory;
                    //$resultF['num'] = $rows;
                    mysqli_close($dbh); // Đóng kết nối CSDL
                    return json_encode($responseCategory);
                }
            mysqli_close($dbh); // Đóng kết nối CSDL
        }
        //mysqli_close($dbh); // Đóng kết nối CSDL
    }
}

function deletTableCategory($site){
    
    $dbh = mysqli_connect('localhost', 'root', ''); 
    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,'PJ2')){
            die("Unable to select database: " . mysqli_error());
            // Thông báo lỗi nếu chọn CSDL thất bại
        } else {
            if($site == 'themegatee') {
             $sql_stmt = "DELETE FROM themegatee_category"; 
             $result = mysqli_query($dbh,$sql_stmt);
            } 
            // Câu lệnh select
            
            //mysqli_close($dbh); // Đóng kết nối CSDL
        }
        mysqli_close($dbh); // Đóng kết nối CSDL
    }
}

function deletTableTag($site){
    
    $dbh = mysqli_connect('localhost', 'root', ''); 
    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,'PJ2')){
            die("Unable to select database: " . mysqli_error());
            // Thông báo lỗi nếu chọn CSDL thất bại
        } else {
            if($site == 'themegatee') {
             $sql_stmt = "DELETE FROM themegatee_tag"; 
             $result = mysqli_query($dbh,$sql_stmt);
            }
            // Câu lệnh select
            
            //mysqli_close($dbh); // Đóng kết nối CSDL
        }
        mysqli_close($dbh); // Đóng kết nối CSDL
    }
}

function updateCategory($site,$id,$name,$slug){
    $dbh = mysqli_connect('localhost', 'root', ''); 
    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,'PJ2')){
            die("Unable to select database: " . mysqli_error());
            // Thông báo lỗi nếu chọn CSDL thất bại
        } else {
            if($site == 'themegatee') {

             $sql_stmt = "INSERT INTO themegatee_category VALUES ($id,'".$name."','".$slug."')";
             $result = mysqli_query($dbh,$sql_stmt);
            }
            // Câu lệnh select
            
            mysqli_close($dbh); // Đóng kết nối CSDL
        }    
    }
}

function updateTag($site,$id,$name,$slug){
    $dbh = mysqli_connect('localhost', 'root', ''); 
    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,'PJ2')){
            die("Unable to select database: " . mysqli_error());
            // Thông báo lỗi nếu chọn CSDL thất bại
        } else {
            if($site == 'themegatee') {

             $sql_stmt = "INSERT INTO themegatee_tag VALUES ($id,'".$name."','".$slug."')";
             $result = mysqli_query($dbh,$sql_stmt);
            }
            // Câu lệnh select
            
            mysqli_close($dbh); // Đóng kết nối CSDL
        }    
    }
}



?>