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

<title>Themegatee Edit Product</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="/PJ2/bootstrap/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<link rel="icon" href="/favicon.png" type="image/x-icon">

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<link rel="stylesheet" href="/project1/mystyle.css">
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
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

<div class="w-100 p-3">
  <div class="row">
   <div class="col-12">

      <div class="masthead">
       
  
      <?php include 'edit-product.php'; ?>

        <form style="padding: 50px;">
            <div class="col-sm-6 my-1">
              <label class="sr-only" for="inlineFormInputGroupSearchText">Title</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">Search title</div>
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
        window.location.href = '/PJ2/themegatee-editproduct.php?page=' + searchPage + '&perpage='+ searchPerPage + '&searchTitle='+ searchTitle;
    }
  </script>

</body>
</html>