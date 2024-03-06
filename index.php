
<?php
  session_start();
  if(isset($_SESSION['PJ2_loggedin']) && $_SESSION['PJ2_loggedin'] === true) {
      /*session_unset();
      // Hủy phiên
      session_destroy();
      // Chuyển hướng người dùng đến trang đăng nhập
      header("location: login.php");
      exit;*/
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

<title>HOME PAGE</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="/PJ2/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/PJ2/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/PJ2/mystyle.css">
<link rel="icon" href="/fav.png" type="image/x-icon">
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<style>



</style>

</head>

<body>




<nav class="navbar navbar-expand-lg navbar-light bg-light">
    
    <img src="/PJ2/logo.gif" alt="Logo" style="padding-left: 50px;" width="310">
    <div class="collapse navbar-collapse" id="navbarNav" style="padding-right: 40px;">
        <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $_SESSION['PJ2_name']; ?></a>
                </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          
                    <img src="/PJ2/avatar-user.jpg" alt="Avatar" style="width: 30px; height: 30px; border-radius: 50%;">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Link 1</a>
                    <a class="dropdown-item" href="#">Link 2</a>
                    <div class="dropdown-divider"></div>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="submit" class="dropdown-item" name="logout" value="Đăng xuất">
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>



<div class="container mt-5">
    <h1>Welcome</h1>
    <p>Xin chào, <?php echo $_SESSION['PJ2_name']; ?>!</p>
    
    <?php include 'menu.php'; ?> 


</div>
  

</body>
</html>   