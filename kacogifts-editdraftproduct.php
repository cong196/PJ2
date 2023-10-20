<?php 
$nextpage = 1;

$page = $_GET['page'];
settype($page, "int");

$perpage = 10;
settype($perpage, "int");

$searchTxt = $_GET['searchTitle'];


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>Kacogifts Edit Product</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="/PJ2/bootstrap/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<link rel="icon" href="/favicon.png" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->



<!--<link rel="stylesheet" href="/project1/mystyle.css"> -->
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>



<style>

.masthead {
  height: 100vh;
  min-height: 500px;
  background-size: 1000px 1000px;
  background-position: center;
  background-repeat: no-repeat;
  padding-top: 45px;
}

</style>
<script type="text/javascript">

</script>
</head>

<body style="padding-bottom: 20px;">
<?php include 'menu.php'; ?>

<div>
  <div class="row">
   <div class="col-12">

      <div>
       
  
      <?php include 'editdraft-product2.php'; ?>

        <form style="padding: 50px;">
            <div class="col-sm-6 my-1">
              <label class="sr-only" for="inlineFormInputGroupSearchText">Title</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-t ext">Search title</div>
              </div>
              <input type="text" class="form-control" id="searchTitle" placeholder="">
            </div>
          </div>

            <div class="col-sm-6 my-1">
              <label class="sr-only" for="inlineFormInputGroupPage">Page</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">Page</div>
              </div>
              <input type="number" class="form-control" id="searchPage" value=1>
            </div>
          </div>

          <div class="col-sm-6 my-1">
              <label class="sr-only" for="inlineFormInputGroupPage">Per/Page</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">Per/Page</div>
              </div>
              <input type="number" class="form-control" value=10 id="searchPerPage">
            </div>
          </div>


          <div class="col-sm-6 my-1">

          <input class="btn btn-primary" type="button" value="Search" name="nextPage" id ="nextPage" onclick="clickSubmit()" />
          </div>
        </form> 
      </div>
    </div>




  <script type="text/javascript">
    
    $( document ).ready(function() {
        //$('#searchTitle').value = <?php echo $searchTxt?>;
        document.getElementById("searchTitle").value = "<?php echo $searchTxt?>";
        document.getElementById("searchPage").value = "<?php echo $page?>";
        document.getElementById("searchPerPage").value = "<?php echo $perpage?>";
    });

    function clickSubmit(){
        let searchPage = document.getElementById("searchPage").value;
        let searchTitle = document.getElementById("searchTitle").value;
        let searchPerPage = document.getElementById("searchPerPage").value;
        //alert(searchPerPage);
        //getPrducts(searchPage,searchPerPage,searchTitle);
        window.location.href = '/PJ2/kacogifts-editdraftproduct.php?page=' + searchPage + '&perpage='+ searchPerPage + '&searchTitle='+ searchTitle;
    }
  </script>

</body>
</html>