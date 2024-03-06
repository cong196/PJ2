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
    use Automattic\WooCommerce\Client;
    require __DIR__ . '/vendor/autoload.php';
    include "dbConnect.php";
    include "config.php";

  /* $list = getdataCategory('kacogifts');
   $someArray = json_decode($list, true);*/

   $listTag = getdataTag('kacogifts');
   $listTag2 = json_decode($listTag, true);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>kacogifts Setting</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!--<link rel="stylesheet" href="/PJ2/mystyle.css"> -->
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/PJ2/getCategoryDB.js"></script>
<script type="text/javascript" src="/PJ2/getCategorySite.js"></script>

<script type="text/javascript" src="/PJ2/getTagSite.js"></script>
<script type="text/javascript" src="/PJ2/getProductLink.js"></script>
<script type="text/javascript" src="/PJ2/getnewProductLink.js"></script>
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
            <h2>Kacogifts.com setting</h2>


<div style="background-color:#F0F0F0">
<h3 style="padding-left:25px;padding-top: 25px;">Category</h3>
<div style="padding-left: 25px; padding-top: 25px;">
  <button type="button" id="btnButton" onclick="getCategoriesSite('kacogifts')" class="btn btn-primary">Update category from store</button>

<button id="btnButton-loading" style="display: none;" class="btn btn-primary" type="button" disabled>
  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  <span class="visually-hidden"></span>
</button>

<!-- <button type="button" onclick="test11()" class="btn btn-primary">Clicked</button>
 --></div>

<div style="padding:25px">
<div id="data"> 
    
</div>
</div>
</div>

<div style="background-color:#F0F0F0; margin-top: 15px;">
<h3 style="padding-left:25px;padding-top: 25px;">TAG</h3>
<div style="padding-left: 25px; padding-top: 25px;">
  <button type="button" id="btnButtonTag" onclick="getTagsSite('kacogifts')" class="btn btn-primary">Update tag from store</button>

<button id="btnButtonTag-loading" style="display: none;" class="btn btn-primary" type="button" disabled>
  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  <span class="visually-hidden"></span>
</button>

<!-- <button type="button" onclick="test11()" class="btn btn-primary">Clicked</button>
 --></div>

<div style="padding:25px">
<div id="data"> 
    <select id="listTaggg" class="form-control selectpicker" multiple data-live-search="true">
    <?php 
        $index2 = 0;
        while($index2 < count($listTag2)) {
    ?>
      <option value="<?php echo $listTag2[$index2]["id"] ?>"><?php echo $listTag2[$index2]["name"] ?></option>
    <?php
        $index2++;
        }
    ?>
    </select>
</div>
</div>
</div>

<div style="background-color:#F0F0F0; margin-top: 15px;">
<h3 style="padding-left:25px;padding-top: 25px;">Update product link</h3>

<!-- <div style="padding-left: 25px; padding-top: 25px;">
  <button type="button" id="btngetProductLink" onclick="getProductLink('kacogifts')" class="btn btn-primary">Get all products</button>

<button id="btngetProductLink-loading" style="display: none;" class="btn btn-primary" type="button" disabled>
  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  <span class="visually-hidden"></span>
</button>

</div> -->


<!-- <div style="padding-left: 25px; padding-top: 25px;">
<div class="row">
  <div class="col-1">
    <button type="button" id="btngetnewProductLink" onclick="getnewProductLink('kacogifts')" class="btn btn-primary">Get new products</button>
    <button id="btngetnewProductLink-loading" style="display: none;" class="btn btn-primary" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span class="visually-hidden"></span>
    </button>
  </div>
  <div class="col-1">
    
    <input type="number" id="txtgetnewProductLink" class="form-control" placeholder="Enter text">
  </div>
</div>
</div> -->

<!-- <div style="padding-left: 25px; padding-top: 25px;">
  <button type="button" id="btnDeleteProductLink" onclick="deleteProductLink('kacogifts')" class="btn btn-danger">Delete all products</button>
<button id="btnDeleteProductLink-loading" style="display: none;" class="btn btn-primary" type="button" disabled>
  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  <span class="visually-hidden"></span>
</button>
</div> -->


<br/>
</div>


</div>
</div>
</body>
</html>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>