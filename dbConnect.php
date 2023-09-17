<?php
function getdataCategory($site){
        $dbh = mysqli_connect('localhost', 'root', ''); 
            // Kết nối tới MySQL server
        //iUooo6)qQ?5t4591
        if (!$dbh){
            die("Unable to connect to MySQL: " . mysqli_error());
            // Nếu kết nối thất bại thì đưa ra thông báo lỗi
        } else {
            if (!mysqli_select_db($dbh,'PJ2')){
                die("Unable to select database: " . mysqli_error());
                // Thông báo lỗi nếu chọn CSDL thất bại
            } else {
                if($site == 'themegatee' || $site == 'themegatee-editproducts.php' || $site == 'themega-editdraftproduct.php' || $site == 'themegatee.php') {
                    $sql_stmt = "SELECT * FROM themegatee_category"; 
                    // Câu lệnh select
                    $result = mysqli_query($dbh,$sql_stmt);
                    $rows = mysqli_num_rows($result); 
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
                    mysqli_close($dbh);
                    return json_encode($responseCategory);
            }
            mysqli_close($dbh);
        }
    }
}

function getdataPostCategory($site){
        $dbh = mysqli_connect('localhost', 'root', ''); 
            // Kết nối tới MySQL server
        //iUooo6)qQ?5t4591
        if (!$dbh){
            die("Unable to connect to MySQL: " . mysqli_error());
            // Nếu kết nối thất bại thì đưa ra thông báo lỗi
        } else {
            if (!mysqli_select_db($dbh,'PJ2')){
                die("Unable to select database: " . mysqli_error());
                // Thông báo lỗi nếu chọn CSDL thất bại
            } else {
                if($site == 'themegatee' || $site == 'themegatee-editproducts.php' || $site == 'themega-editdraftproduct.php' || $site == 'themegatee.php') {
                    $sql_stmt = "SELECT * FROM themegatee_postcategory"; 
                    // Câu lệnh select
                    $result = mysqli_query($dbh,$sql_stmt);
                    $rows = mysqli_num_rows($result); 
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
                    mysqli_close($dbh);
                    return json_encode($responseCategory);
            }
            mysqli_close($dbh);
        }
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
                    $result = mysqli_query($dbh,$sql_stmt);
                    $rows = mysqli_num_rows($result); 
                    
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
                    mysqli_close($dbh); // Đóng kết nối CSDL
                    return json_encode($responseCategory);
                }
            mysqli_close($dbh);
        }
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
        }
        mysqli_close($dbh);
    }
}

function deletTablePostCategory($site){
    
    $dbh = mysqli_connect('localhost', 'root', ''); 
    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,'PJ2')){
            die("Unable to select database: " . mysqli_error());
            // Thông báo lỗi nếu chọn CSDL thất bại
        } else {
            if($site == 'themegatee') {
                 $sql_stmt = "DELETE FROM themegatee_postcategory"; 
                 $result = mysqli_query($dbh,$sql_stmt);
            }
        }
        mysqli_close($dbh);
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
        }
        mysqli_close($dbh);
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
        } else {
            if($site == 'themegatee') {
             $sql_stmt = "INSERT INTO themegatee_category VALUES ($id,'".$name2."','".$slug."','".$parent."')";
             $result = mysqli_query($dbh,$sql_stmt);
            }
            
            mysqli_close($dbh);
        }    
    }
}

function updatePostCategory($site,$id,$name,$slug, $parent){
    $dbh = mysqli_connect('localhost', 'root', '');
    $name2 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $name);
    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,'PJ2')){
            die("Unable to select database: " . mysqli_error());
        } else {
            if($site == 'themegatee') {
             $sql_stmt = "INSERT INTO themegatee_postcategory VALUES ($id,'".$name2."','".$slug."','".$parent."')";
             $result = mysqli_query($dbh,$sql_stmt);
            }
            
            mysqli_close($dbh);
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
        } else {
            if($site == 'themegatee' || $site == 'themega-editdraftproduct.php') {

             $sql_stmt = "INSERT INTO themegatee_tag VALUES ($id,'".$name2."','".$slug."')";
             $result = mysqli_query($dbh,$sql_stmt);
            }
            
            mysqli_close($dbh);
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
        } else {
            if($site == 'themegatee-editproduct.php' || $site == 'themega-editdraftproduct.php' || $site == 'themegatee-setting.php' || $site == 'themegatee') {


                $query = "SELECT id FROM themegaproductlink WHERE id = $id";
                $rsExits = mysqli_query($dbh, $query);

                if (mysqli_num_rows($rsExits) > 0) {
                    $slug = 'https://themegatee.com/product/' . $slug;
                    $updateExits = "UPDATE themegaproductlink SET slug = '".$slug."' WHERE id =".$id;
                    $result = mysqli_query($dbh,$updateExits);
                } else {
                    $slug = 'https://themegatee.com/product/' . $slug;
                    $sql_stmt = "INSERT INTO themegaproductlink VALUES ($id,'".$name2."','".$slug."','".$category."')";
                    $result = mysqli_query($dbh,$sql_stmt);
                }
                 
            }
            
            mysqli_close($dbh);
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
            if($site == 'themega-editdraftproduct.php' || $site == 'themegatee.php' || $site == 'themegatee') {
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
    }
}

function getRandomRelatedProduct($site,$id,$title){
    $conn = new mysqli('localhost', 'root', '','PJ2');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return 0;
    } else {
            $sql = "";
            if($site == 'themega-editdraftproduct.php') {
                //$sql = "SELECT * FROM `themegaproductlink` WHERE `productcategory` LIKE '%" . $id . "%' ORDER BY RAND() LIMIT 1;";
                if($title != ''){
                    $sql = "SELECT * FROM `themegaproductlink` WHERE `name` LIKE '%".$title."%' AND FIND_IN_SET('$id', `productcategory`) ORDER BY RAND() LIMIT 1;";
                } else {
                    $sql = "SELECT * FROM `themegaproductlink` WHERE FIND_IN_SET('$id', `productcategory`) ORDER BY RAND() LIMIT 1;";
                }
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    return $row;
                } else {
                    return 0;
                }
            }
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

function getClosing($site){
    
    $conn = new mysqli('localhost', 'root', '','PJ2');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return 0;
    } else {
            $sql = "";
            $sql = "SELECT * FROM closing ORDER BY RAND() LIMIT 1;";
            $result = $conn->query($sql);
            $conn->close();
            //return $result->fetch_assoc();

            $ct = $result->fetch_assoc();
            $content = $ct["content"];

            if($site == 'themega-editdraftproduct.php') {
                $randomAchortext = "Themegatee.com,Themegatee,our shop";
                $values = explode(',', $randomAchortext);
                $values = array_map('trim', $values);
                $randomValue = $values[array_rand($values)];

                $insertLink = "<strong><a href=\"https://themegatee.com\"> ". $randomValue . "</a></strong>";
                $position = strrpos($content, 'Inserthere');
                if ($position !== false) {
                    $content = substr_replace($content, $insertLink, $position, strlen('Inserthere'));
                    return $content;
                } else {
                    return 0;
                }
            }

    }
}

function getKeywordCategory($category){
    $conn = new mysqli('localhost', 'root', '', 'PJ2');
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return [];
    } else {
        $sql = "SELECT * FROM keywords_test WHERE `category` = '" . $category . "'";

        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $data = [];
            
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;  // Store each row in the $data array
            }
            
            $conn->close();
            return $data;
        } else {
            $conn->close();
            return [];
        }
    }
}

function insertkeywords($site,$category,$keyword,$volume, $type){
    $dbh = mysqli_connect('localhost', 'root', '');
    $keyword = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $keyword);
    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,'PJ2')){
            die("Unable to select database: " . mysqli_error());
        } else {
            $sql_stmt = "INSERT INTO keywords_test (category, keyword, volume, type) 
             VALUES ('".$category."','".$keyword."',".$volume.",'".$type."') 
             ON DUPLICATE KEY UPDATE volume = " . $volume . ", type = '".$type."';";
            $result = mysqli_query($dbh,$sql_stmt);
            mysqli_close($dbh);
        }    
    }
}


?>