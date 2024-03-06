<?php 

    session_start();
    if(isset($_SESSION['PJ2_loggedin']) && $_SESSION['PJ2_loggedin'] === true) {
    } else {
      header("location: login.php");
      exit;
    }


    // Xử lý logout nếu người dùng bấm nút "Đăng xuất"
    if(isset($_POST['logout'])) {
      // Xóa tất cả các biến session
      session_unset();
      // Hủy phiên
      session_destroy();
      // Chuyển hướng người dùng đến trang đăng nhập
      header("location: login.php");
      exit;
    }
  

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>Trang chủ</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="/PJ2/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/PJ2/mystyle.css">

<link rel="icon" href="/favicon.png" type="image/x-icon">
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="/PJ2/custom_css.css">


</head>

<body>

<?php include 'topbar.php'; ?>
<!-- Bootstrap row -->
<div class="row" id="body-row">
    <!-- Sidebar -->
    <?php include 'slider_bar.php'; ?>
    <!-- sidebar-container END -->
    <!-- MAIN -->
    <div class="col p-4">
        <div class="container-fluid">
    <div class="row">
    
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            Dashboard
          </div>
          <div class="card-body">
            <!-- Dashboard content here -->
            <h1>Welcome to the Dashboard!</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
        
        

    </div><!-- Main Col END -->
</div>
</body>
</html>   