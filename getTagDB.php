<?php 

$site =  $_POST['site'];
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
		 $sql_stmt = "SELECT * FROM themegatee_tag"; 
	    // Câu lệnh select
	    $result = mysqli_query($dbh,$sql_stmt);
	  	$rows = mysqli_num_rows($result); 
	     // Lấy số hàng trả về
	    
	    if ($rows) {
	        while ($row = mysqli_fetch_array($result)) {         
	            echo 'ID: ' . $row['id'] . '<br>';         
	            echo 'Full Names: ' . $row['name'] . '<br>';        
	            echo 'slug: ' . $row['slug'] . '<br>';   
	        } 
	    } 
		mysqli_close($dbh); // Đóng kết nối CSDL
	}    
}
    

?>