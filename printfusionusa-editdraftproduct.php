<?php 
$nextpage = 1;

$page = $_GET['page'];
settype($page, "int");

$perpage = 10;
settype($perpage, "int");

$searchTxt = $_GET['searchTitle'];

$sort_by = $_GET['sort_by'];
settype($sort_by, "int");

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>Printfusionusa Draft Product</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="/PJ2/bootstrap/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<link rel="icon" href="/favicon.png" type="image/x-icon">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

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
      <?php include 'editdraft-product-2.php'; ?>
      
      <form style="padding: 0px 50px 50px 50px;">
        <div class="row">
        <div class="col-sm-3 my-1">
          <select class="form-select" id="select_sort_by" aria-label="Default select example">
            <option value="1">Sort by Old to New</option>
            <option value="2">Sort by New to Old</option>
          </select>
        </div>
      </div>

        <div class="row">
            <div class="col-sm-3 my-1">
                <label class="sr-only" for="searchTitle">Title</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Search title</div>
                    </div>
                    <input type="text" class="form-control" id="searchTitle" placeholder="">
                </div>
            </div>
            <div class="col-sm-1 my-1">
                <label class="sr-only" for="searchPage">Page</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Page</div>
                    </div>
                    <input type="number" class="form-control" id="searchPage" value=1>
                </div>
            </div>
            <div class="col-sm-2 my-1">
                <label class="sr-only" for="inlineFormInputGroupPage">Per/Page</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Per/Page</div>
                    </div>
                    <input type="number" class="form-control" value=10 id="searchPerPage">
                </div>
            </div>
            <div class="col-sm-2 my-1">
                <input class="btn btn-primary" type="button" value="Search" name="nextPage" id="nextPage" onclick="clickSubmit()" />
            </div>
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
        document.getElementById("select_sort_by").value = "<?php echo $sort_by?>";
    });

    function clickSubmit(){
        let searchPage = document.getElementById("searchPage").value;
        let searchTitle = document.getElementById("searchTitle").value;
        let searchPerPage = document.getElementById("searchPerPage").value;

        let selectSortby = document.getElementById("select_sort_by");
        let selectedSortbyValue = selectSortby.value;
        window.location.href = '/PJ2/printfusionusa-editdraftproduct.php?page=' + searchPage + '&perpage='+ searchPerPage + '&sort_by='+ selectedSortbyValue +'&searchTitle='+ searchTitle;
    }
  </script>

</body>
</html>