<?php
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "PJ2";



function getdataCategory($site){
    global $servername, $username, $password, $database_name;
        $dbh = mysqli_connect($servername, $username, $password); 
            // Kết nối tới MySQL server
        //iUooo6)qQ?5t4591
        if (!$dbh){
            die("Unable to connect to MySQL: " . mysqli_error());
            // Nếu kết nối thất bại thì đưa ra thông báo lỗi
        } else {
            if (!mysqli_select_db($dbh,$database_name)){
                die("Unable to select database: " . mysqli_error());
                // Thông báo lỗi nếu chọn CSDL thất bại
            } else {
                if($site == 'themegatee' || $site == 'themegatee-editproducts.php' || $site == 'themega_editdraftproduct.php' || $site == 'themega-editdraftproduct.php' || $site == 'themegatee.php') {
                    $sql_stmt = "SELECT * FROM themegatee_category"; 
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
                } else {
                    if($site == 'customjoygifts' || $site == 'customjoygifts-editproducts.php' || $site == 'customjoygifts_editdraftproduct.php' || $site == 'customjoygifts-editdraftproduct.php' || $site == 'customjoygifts.php') {
                        $sql_stmt = "SELECT * FROM customjoygifts_category"; 
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
                }
            mysqli_close($dbh);
        }
    }
}

function getdataPostCategory($site){
    global $servername, $username, $password, $database_name;
        $dbh = mysqli_connect($servername, $username, $password);

            // Kết nối tới MySQL server
        //iUooo6)qQ?5t4591
        if (!$dbh){
            die("Unable to connect to MySQL: " . mysqli_error());
            // Nếu kết nối thất bại thì đưa ra thông báo lỗi
        } else {
            if (!mysqli_select_db($dbh,$database_name)){
                die("Unable to select database: " . mysqli_error());
                // Thông báo lỗi nếu chọn CSDL thất bại
            } else {
                if($site == 'themegatee' || $site == 'themegatee-editproducts.php' || $site == 'themega_editdraftproduct.php' || $site == 'themega-editdraftproduct.php' || $site == 'themegatee.php') {
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
      global $servername, $username, $password, $database_name;
        $dbh = mysqli_connect($servername, $username, $password); 
            // Kết nối tới MySQL server
        if (!$dbh){
            die("Unable to connect to MySQL: " . mysqli_error());
            // Nếu kết nối thất bại thì đưa ra thông báo lỗi
        } else {
            if (!mysqli_select_db($dbh,$database_name)){
                die("Unable to select database: " . mysqli_error());
                // Thông báo lỗi nếu chọn CSDL thất bại
            } else {
                if($site == 'themegatee' || $site == 'themegatee-editproducts.php' || $site == 'themega_editdraftproduct.php' || $site == 'themega-editdraftproduct.php') {
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
                } else {
                    if($site == 'customjoygifts' || $site == 'customjoygifts-editproducts.php' || $site == 'customjoygifts_editdraftproduct.php' || $site == 'customjoygifts-editdraftproduct.php') {
                        $sql_stmt = "SELECT * FROM customjoygifts_tag"; 
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
                }
            mysqli_close($dbh);
        }
    }
}

function deletTableCategory($site){
    global $servername, $username, $password, $database_name;
    $dbh = mysqli_connect($servername, $username, $password); 
    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,$database_name)){
            die("Unable to select database: " . mysqli_error());
            // Thông báo lỗi nếu chọn CSDL thất bại
        } else {
            if($site == 'themegatee') {
             $sql_stmt = "DELETE FROM themegatee_category"; 
             $result = mysqli_query($dbh,$sql_stmt);
            } else {
                if($site == 'customjoygifts') {
                 $sql_stmt = "DELETE FROM customjoygifts_category"; 
                 $result = mysqli_query($dbh,$sql_stmt);
                }
            }
        }
        mysqli_close($dbh);
    }
}

function deletTablePostCategory($site){
    global $servername, $username, $password, $database_name;
    $dbh = mysqli_connect($servername, $username, $password); 
    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,$database_name)){
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
    global $servername, $username, $password, $database_name;
    $dbh = mysqli_connect($servername, $username, $password); 
    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,$database_name)){
            die("Unable to select database: " . mysqli_error());
            // Thông báo lỗi nếu chọn CSDL thất bại
        } else {
            if($site == 'themegatee') {
             $sql_stmt = "DELETE FROM themegatee_tag"; 
             $result = mysqli_query($dbh,$sql_stmt);
            } else {
                if($site == 'kacogifts') {
                     $sql_stmt = "DELETE FROM kacogifts_tag"; 
                     $result = mysqli_query($dbh,$sql_stmt);
                } else {
                    if($site == 'customjoygifts') {
                         $sql_stmt = "DELETE FROM customjoygifts_tag"; 
                         $result = mysqli_query($dbh,$sql_stmt);
                    }
                }
            }
        }
        mysqli_close($dbh);
    }
}

function updateCategory($site,$id,$name,$slug, $parent){
    global $servername, $username, $password, $database_name;
    $dbh = mysqli_connect($servername, $username, $password);
    $name2 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $name);
    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,$database_name)){
            die("Unable to select database: " . mysqli_error());
        } else {
            if($site == 'themegatee' || $site == 'themega-editdraftproduct.php') {
                $check_sql = "SELECT * FROM themegatee_category WHERE id = $id";
                $check_result = mysqli_query($dbh, $check_sql);
                if (mysqli_num_rows($check_result) == 0) {
                     $sql_stmt = "INSERT INTO themegatee_category VALUES ($id,'".$name2."','".$slug."','".$parent."')";
                     $result = mysqli_query($dbh,$sql_stmt);
                }
            } else {
                if($site == 'customjoygifts' || $site == 'customjoygifts-editdraftproduct.php') {
                    $check_sql = "SELECT * FROM customjoygifts_category WHERE id = $id";
                    $check_result = mysqli_query($dbh, $check_sql);
                    if (mysqli_num_rows($check_result) == 0) {
                        $sql_stmt = "INSERT INTO customjoygifts_category VALUES ($id,'".$name2."','".$slug."','".$parent."')";
                        $result = mysqli_query($dbh,$sql_stmt);
                    }
                }
            }
            
            mysqli_close($dbh);
        }    
    }
}

function addCategoryTerms($name) {
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password, $database_name);
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->begin_transaction();

    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM category_term WHERE category = ? AND term = ?");
    $checkStmt->bind_param("ss", $name, $name);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count == 0) {
        // Insert the record if it doesn't exist
        $stmt = $conn->prepare("INSERT INTO category_term (category, term) VALUES (?, ?)");
        if ($stmt === FALSE) {
            exit;
        }

        $stmt->bind_param("ss", $name, $name);

        if (!$stmt->execute()) {
        }
        $stmt->close();
    }
    $conn->commit();
}

function updatePostCategory($site,$id,$name,$slug, $parent){
    global $servername, $username, $password, $database_name;
    $dbh = mysqli_connect($servername, $username, $password);
    $name2 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $name);
    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,$database_name)){
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
    global $servername, $username, $password, $database_name;
    $dbh = mysqli_connect($servername, $username, $password);
    $name2 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $name);
    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,$database_name)){
            die("Unable to select database: " . mysqli_error());
        } else {
            if($site == 'themegatee' || $site == 'themega_editdraftproduct.php' || $site == 'themega-editdraftproduct.php') {

             $sql_stmt = "INSERT INTO themegatee_tag VALUES ($id,'".$name2."','".$slug."')";
             $result = mysqli_query($dbh,$sql_stmt);
            } else {
                if($site == 'kacogifts' || $site == 'kacogifts_editdraftproduct.php' || $site == 'kacogifts-editdraftproduct.php') {
                     $sql_stmt = "INSERT INTO kacogifts_tag VALUES ($id,'".$name2."','".$slug."')";
                     $result = mysqli_query($dbh,$sql_stmt);
                } else {
                    if($site == 'customjoygifts' || $site == 'customjoygifts_editdraftproduct.php' || $site == 'customjoygifts-editdraftproduct.php') {
                         $sql_stmt = "INSERT INTO customjoygifts_tag VALUES ($id,'".$name2."','".$slug."')";
                         $result = mysqli_query($dbh,$sql_stmt);
                    }
                }
            }
            
            mysqli_close($dbh);
        }    
    }
}


function updateProductlink($site,$id,$name,$slug,$category){
    global $servername, $username, $password, $database_name;
    $dbh = mysqli_connect($servername, $username, $password);
    $name2 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $name);

    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,$database_name)){
            die("Unable to select database: " . mysqli_error());
        } else {
            if($site == 'themegatee-editproduct.php' || $site == 'themega_editdraftproduct.php' || $site == 'themega-editdraftproduct.php' || $site == 'themegatee-setting.php' || $site == 'themegatee') {


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
                 
            } else {
                if($site == 'kacogifts-editproduct.php' || $site == 'kacogifts_editdraftproduct.php' || $site == 'kacogifts-editdraftproduct.php' || $site == 'kacogifts-setting.php' || $site == 'kacogifts') {
                    $query = "SELECT id FROM kacogiftsproductlink WHERE id = $id";
                    $rsExits = mysqli_query($dbh, $query);

                    if (mysqli_num_rows($rsExits) > 0) {
                        $slug = 'https://kacogifts.com/product/' . $slug;
                        $updateExits = "UPDATE kacogiftsproductlink SET slug = '".$slug."' WHERE id =".$id;
                        $result = mysqli_query($dbh,$updateExits);
                    } else {
                        $slug = 'https://kacogifts.com/product/' . $slug;
                        $sql_stmt = "INSERT INTO kacogiftsproductlink VALUES ($id,'".$name2."','".$slug."','".$category."')";
                        $result = mysqli_query($dbh,$sql_stmt);
                    }
                     
                } else {
                    if($site == 'customjoygifts-editproduct.php' || $site == 'customjoygifts_editdraftproduct.php' || $site == 'customjoygifts-editdraftproduct.php' || $site == 'customjoygifts-setting.php' || $site == 'customjoygifts') {
                        $query = "SELECT id FROM customjoygiftsproductlink WHERE id = $id";
                        $rsExits = mysqli_query($dbh, $query);

                        if (mysqli_num_rows($rsExits) > 0) {
                            $slug = 'https://customjoygifts.com/product/' . $slug;
                            $updateExits = "UPDATE customjoygiftsproductlink SET slug = '".$slug."' WHERE id =".$id;
                            $result = mysqli_query($dbh,$updateExits);
                        } else {
                            $slug = 'https://customjoygifts.com/product/' . $slug;
                            $sql_stmt = "INSERT INTO customjoygiftsproductlink VALUES ($id,'".$name2."','".$slug."','".$category."')";
                            $result = mysqli_query($dbh,$sql_stmt);
                        }
                         
                    }
                }
            }
            mysqli_close($dbh);
        }    
    }
}

function getlinkCategory($site,$id){
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password,$database_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return 0;
    } else {
            $sql = "";
            if($site == 'themega-editdraftproduct.php' || $site == 'themega_editdraftproduct.php' || $site == 'themegatee.php' || $site == 'themegatee') {
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
            } else {
                if($site == 'customjoygifts-editdraftproduct.php' || $site == 'customjoygifts_editdraftproduct.php' || $site == 'customjoygifts.php' || $site == 'customjoygifts') {
                    $sql = "SELECT * FROM customjoygifts_category WHERE id = $id;";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    $parent1 = $row["parent"];
                    $link = $row["slug"];

                    while ($parent1 != 0 ) {
                        $sql = "SELECT * FROM `customjoygifts_category` WHERE id = $parent1;";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $parent1 = $row["parent"];
                        $link = $row["slug"] . '/' . $link;
                    }
                    $conn->close();
                    $link = 'https://customjoygifts.com/' . $link;
                    return $link;
                }
            }
    }
}

function getRandomRelatedProduct($site,$id,$title){
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password,$database_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return 0;
    } else {
            $sql = "";
            if($site == 'themega-editdraftproduct.php' || $site == 'themega_editdraftproduct.php') {
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
            } else {
                if($site == 'customjoygifts-editdraftproduct.php' || $site == 'customjoygifts_editdraftproduct.php') {
                    if($title != ''){
                        $sql = "SELECT * FROM `customjoygiftsproductlink` WHERE `name` LIKE '%".$title."%' AND FIND_IN_SET('$id', `productcategory`) ORDER BY RAND() LIMIT 1;";
                    } else {
                        $sql = "SELECT * FROM `customjoygiftsproductlink` WHERE FIND_IN_SET('$id', `productcategory`) ORDER BY RAND() LIMIT 1;";
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
}

function getclosingParagraph(){
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password,$database_name);
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
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password,$database_name);
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

            if($site == 'themega-editdraftproduct.php' || $site == 'themega_editdraftproduct.php') {
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
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password, $database_name);
    
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
    global $servername, $username, $password, $database_name;
    $dbh = mysqli_connect($servername, $username, $password);
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

function check_tags_exist($tag,$page_name) {
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password,$database_name);
    if ($conn->connect_error) {
        //die("Connection failed: " . $mysqli->connect_error);
        return 3;
    } else {
        $query = "";
        if($page_name == 'kacogifts' || $page_name == 'kacogifts-editdraftproduct.php') {
            $query = "SELECT COUNT(*) AS tag_count FROM kacogifts_tag WHERE name = '$tag'";
        } else {
            if($page_name == 'customjoygifts' || $page_name == 'customjoygifts-editdraftproduct.php') {
                $query = "SELECT COUNT(*) AS tag_count FROM customjoygifts_tag WHERE name = '$tag'";
            }
        }

        $result = $conn->query($query);
        if ($result) {
            $row = $result->fetch_assoc();
            $tagCount = $row['tag_count'];
            $conn->close();
            return $tagCount > 0 ? 1 : 2;
        } else {
            $conn->close();
            return 3;;
        }
    }
}

function get_link_tag($tag0,$site) {
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password,$database_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return 0;
    } else {
            $sql = "";
            if($site == 'kacogifts-editdraftproduct.php' || $site == 'kacogifts') {
                $sql = "SELECT * FROM kacogifts_tag WHERE name = '".$tag0."'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $link = $row["slug"];
                $conn->close();

                $link = 'https://kacogifts.com/product-tag/' . $link;
                return $link;
            } else {
                if($site == 'customjoygifts-editdraftproduct.php' || $site == 'customjoygifts') {
                    $sql = "SELECT * FROM customjoygifts_tag WHERE name = '".$tag0."'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $link = $row["slug"];
                    $conn->close();

                    $link = 'https://customjoygifts.com/product-tag/' . $link;
                    return $link;
                }
            }
    }
}
function get_id_tag($name, $site) {
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password,$database_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return 0;
    } else {
            $sql = "";
            if($site == 'kacogifts-editdraftproduct.php' || $site == 'kacogifts') {
                $sql = "SELECT * FROM kacogifts_tag WHERE name = '".$name."'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $id = $row["id"];
                $conn->close();
                return $id;
            } else {
                if($site == 'customjoygifts-editdraftproduct.php' || $site == 'customjoygifts') {
                    $sql = "SELECT * FROM customjoygifts_tag WHERE name = '".$name."'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $id = $row["id"];
                    $conn->close();
                    return $id;
                }
            }
    }
}


function get_related_product($site,$title){
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password,$database_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return 0;
    } else {
            $sql = "";
            if($site == 'kacogifts-editdraftproduct.php') {
                $sql = "SELECT * FROM `kacogiftsproductlink` WHERE `name` LIKE '%" . $title . "%' ORDER BY RAND() LIMIT 1;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    return $row;
                } else {
                    return 0;
                }
            } else {
                if($site == 'customjoygifts-editdraftproduct.php') {
                    $sql = "SELECT * FROM `customjoygiftsproductlink` WHERE `name` LIKE '%" . $title . "%' ORDER BY RAND() LIMIT 1;";
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
}


function findCategoriesInTitle($title) {
    global $servername, $username, $password, $database_name;

    // Kết nối đến cơ sở dữ liệu
    $conn = new mysqli($servername, $username, $password, $database_name);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT term FROM category_term";
    $result = $conn->query($sql);

    $matchingTerms = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if (stripos($title, $row['term']) !== false) {
                $matchingTerms[] = $row['term'];
            }
        }
    }

    $conn->close();
    return implode(",", $matchingTerms);
}



function get_tags_terms(){
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password,$database_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return 0;
    } else {
            $sql = "";
            $sql = "SELECT tag_terms FROM `tag_terms`";
            $result = $conn->query($sql);
            $tags = [];
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $tags[] = $row['tag_terms'];
                }
                return json_encode($tags);
            } else {
                return json_encode([]);
            }
            
    }
}

function get_tags_terms_2(){
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password,$database_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return 0;
    } else {
            $sql = "SELECT tag_terms FROM `tag_terms`";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $tags_string = $row['tag_terms'];
                $tags = array_map(function($tag) {
                    return trim($tag, " \"");  // trim spaces and double quotes
                }, explode(',', $tags_string));
                return $tags;
            } else {
                return [];
            }
            $conn->close();
    }
}

function insert_tags_terms_to_database($terms){
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password,$database_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return 0;
    } else {
            $sql = "SELECT * FROM tag_terms LIMIT 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $existingTagTerm = $row["tag_terms"];

                
                $updatedTagTerm = $existingTagTerm . ',"' . $terms . '"';

                $updateSql = "UPDATE tag_terms SET tag_terms='$updatedTagTerm'"; // Use the appropriate ID or condition for your use case

                if ($conn->query($updateSql) === TRUE) {
                    echo '<div class="container mt-3">
                            <div class="alert alert-success">
                                Tag term updated successfully.
                            </div>
                          </div>';
                } else {
                    echo '<div class="container mt-3">
                            <div class="alert alert-danger">
                                Error updating tag term: ' . $conn->error . '
                            </div>
                          </div>';
                }
            } else {
                echo '<div class="container mt-3">
                        <div class="alert alert-danger">
                            No existing tag terms found in the database.
                        </div>
                      </div>';
            }
            $conn->close();      
    }
}

function update_tag_terms($originalText, $newText) {
    global $servername, $username, $password, $database_name;

    $conn = new mysqli($servername, $username, $password, $database_name);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    } 
    $stmt = $conn->prepare("UPDATE tag_terms SET tag_terms = REPLACE(tag_terms, ?, ?)");
    $stmt->bind_param("ss", $originalText, $newText);

    if ($stmt->execute()) {
        echo "1";
    } else {
        echo "0";
    }

    $stmt->close();
    $conn->close();
}

function get_product_type_terms(){
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password,$database_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return 0;
    } else {
        $sql = "SELECT text, product_type FROM producttype_terms";
        $result = $conn->query($sql);
        $titleClassifier = ['categories' => []];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $titleClassifier['categories'][$row['text']] = $row['product_type'];
            }
        }
        return $titleClassifier;
        $conn->close();
    }
}

function add_product_type_terms($text, $type) {
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password, $database_name);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    } 
    $stmt = $conn->prepare("INSERT INTO producttype_terms (text, product_Type) VALUES (?, ?)");
    $stmt->bind_param("ss", $text, $type);

    if ($stmt->execute()) {
        return "1";
    } else {
        return "Error: " . $stmt->error;;
    }

    $stmt->close();
    $conn->close();
}

function delete_product_type_terms($text) {
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password, $database_name);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    } 
    $stmt = $conn->prepare("DELETE FROM producttype_terms WHERE text = ?");
    $stmt->bind_param("s", $text);

    if ($stmt->execute()) {
        return "1";
    } else {
        return "Error: " . $stmt->error;;
    }

    $stmt->close();
    $conn->close();
}

function addScheduleProduct($id,$site){
    global $servername, $username, $password, $database_name;
    $dbh = mysqli_connect($servername, $username, $password);
    if (!$dbh){
        die("Unable to connect to MySQL: " . mysqli_error());
    } else {
        if (!mysqli_select_db($dbh,$database_name)){
            die("Unable to select database: " . mysqli_error());
        } else {
            if($site == 'themegatee' || $site == 'themega_editdraftproduct.php' || $site == 'themega-editdraftproduct.php') {
                $sql_stmt = "INSERT INTO schedule_product (id, site) VALUES (?, ?)";
                $stmt = mysqli_prepare($dbh, $sql_stmt);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "is", $id, $site);
                    $result = mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }
            } else {
                if($site == 'kacogifts' || $site == 'kacogifts_editdraftproduct.php' || $site == 'kacogifts-editdraftproduct.php') {
                    $sql_stmt = "INSERT INTO schedule_product (id, site) VALUES (?, ?)";
                    $stmt = mysqli_prepare($dbh, $sql_stmt);
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "is", $id, $site);
                        $result = mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                    } 
                } else {
                    if($site == 'customjoygifts' || $site == 'customjoygifts_editdraftproduct.php' || $site == 'customjoygifts-editdraftproduct.php') {
                        $sql_stmt = "INSERT INTO schedule_product (id, site) VALUES (?, ?)";
                        $stmt = mysqli_prepare($dbh, $sql_stmt);
                        if ($stmt) {
                            mysqli_stmt_bind_param($stmt, "is", $id, $site);
                            $result = mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                        } 
                    }
                }
            }
            mysqli_close($dbh);
        }    
    }
}

function checkScheduleStatus($id,$site){
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password,$database_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return false;
    } else {
        $sql = "SELECT id FROM schedule_product WHERE id = $id and site = '".$site."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
        
        
    }
}


function deleteScheduleProduct($id, $site) {
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password, $database_name);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("DELETE FROM schedule_product WHERE id = ? AND site = ?");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("is", $id, $site);
    if ($stmt->execute()) {
        $result = "1";
    } else {
        throw new Exception("Execution failed: " . $stmt->error);
    }
    $stmt->close();
    $conn->close();

    return $result;
}

function getScheduleProductId($site) {
    global $servername, $username, $password, $database_name;
    $conn = new mysqli($servername, $username, $password, $database_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return 0;
    }
    $sql = "SELECT id FROM schedule_product WHERE site = ? LIMIT 1";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $site);
        $stmt->execute();
        $stmt->bind_result($id);
        if ($stmt->fetch()) {
            $stmt->close();
            $conn->close();
            return $id;
        }
        $stmt->close();
    } else {
        //echo "Error preparing statement: " . $conn->error;
        return 0;
    }
    $conn->close();
    return 0;
}



?>