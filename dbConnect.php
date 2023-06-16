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

function updateCategory($site,$id,$name,$slug, $parent){
    $dbh = mysqli_connect('localhost', 'root', '');
    $name2 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $name);
    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,'PJ2')){
            die("Unable to select database: " . mysqli_error());
            // Thông báo lỗi nếu chọn CSDL thất bại
        } else {
            if($site == 'themegatee') {
             $sql_stmt = "INSERT INTO themegatee_category VALUES ($id,'".$name2."','".$slug."','".$parent."')";
             $result = mysqli_query($dbh,$sql_stmt);
            }
            // Câu lệnh select
            
            mysqli_close($dbh); // Đóng kết nối CSDL
        }    
    }
}

function updateTag($site,$id,$name,$slug){
    $dbh = mysqli_connect('localhost', 'root', '');
    $name2 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $name);
    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,'PJ2')){
            die("Unable to select database: " . mysqli_error());
            // Thông báo lỗi nếu chọn CSDL thất bại
        } else {
            if($site == 'themegatee') {

             $sql_stmt = "INSERT INTO themegatee_tag VALUES ($id,'".$name2."','".$slug."')";
             $result = mysqli_query($dbh,$sql_stmt);
            }
            // Câu lệnh select
            
            mysqli_close($dbh); // Đóng kết nối CSDL
        }    
    }
}

function updateProductlink($site,$id,$name,$slug,$category){
    $dbh = mysqli_connect('localhost', 'root', '');
    $name2 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $name);

    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,'PJ2')){
            die("Unable to select database: " . mysqli_error());
            // Thông báo lỗi nếu chọn CSDL thất bại
        } else {
            if($site == 'themegatee-editproduct.php' || $site == 'themega-editdraftproduct.php' || $site == 'themegatee-setting.php' || $site == 'themegatee') {
                 $slug = 'https://themegatee.com/product/' . $slug;
                 $sql_stmt = "INSERT INTO themegaproductlink VALUES ($id,'".$name2."','".$slug."','".$category."')";
                 $result = mysqli_query($dbh,$sql_stmt);
            }
            
            mysqli_close($dbh); // Đóng kết nối CSDL
        }    
    }
}

function getlinkCategory($site,$id){
    $conn = new mysqli('localhost', 'root', '','PJ2');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return 0;
    } else {
            $sql = "";
            if($site == 'themega-editdraftproduct.php') {
                $sql = "SELECT * FROM themegatee_category WHERE id = $id;";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                $parent1 = $row["parent"];
                $link = $row["slug"];

                while ($parent1 != 0 ) {
                    $sql = "SELECT * FROM `themegatee_category` WHERE id = $parent1;";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $parent1 = $row["parent"];
                    $link = $row["slug"] . '/' . $link;
                }
                $conn->close();
                $link = 'https://themegatee.com/' . $link;
                return $link;
            }
            
            //return $result->fetch_assoc();
    }
}

function getRandomRelatedProduct($site,$id){
    $conn = new mysqli('localhost', 'root', '','PJ2');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return 0;
    } else {
            $sql = "";
            if($site == 'themega-editdraftproduct.php') {
                $sql = "SELECT * FROM `themegaproductlink` WHERE `productcategory` LIKE '%" . $id . "%' ORDER BY RAND() LIMIT 1;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    return $row;
                } else {
                    return 0;
                }
            }
            
            //return $result->fetch_assoc();
    }
}

function getclosingParagraph(){
    
    $conn = new mysqli('localhost', 'root', '','PJ2');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return 0;
    } else {
            $sql = "";
            $sql = "SELECT * FROM closingparagraph ORDER BY RAND() LIMIT 1;";
            $result = $conn->query($sql);
            $conn->close();
            return $result->fetch_assoc();
    }
}

?>