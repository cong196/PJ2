<?php

use Automattic\WooCommerce\Client;
require __DIR__ . '/vendor/autoload.php';

include "dbConnect.php";
include "config.php";
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);


$page = $_GET['page'];
settype($page, "int");

$perpage = $_GET['perpage'];
settype($perpage, "int");

$searchTitle = $_GET['searchTitle'];

$sort_by = $_GET['sort_by'];
settype($sort_by, "int");
$site = json_decode(getKey($curPageName));


function getProducts($pg, $perpage,$site,$searchTitle,$sort_by){
  $woocommerce = new Client(
        $site->url, 
        $site->ck, 
        $site->cs,
      [
          'version' => 'wc/v3',
      ]
  );
  if($sort_by == 1) {
    $prds = $woocommerce->get('products/?status=draft&orderby=date&order=asc&page='.$pg.'&per_page='.$perpage . '&search='. $searchTitle);
  } else {
    $prds = $woocommerce->get('products/?status=draft&orderby=date&order=desc&page='.$pg.'&per_page='.$perpage . '&search='. $searchTitle);
  }
  
  return $prds;
};

$g10 = getProducts($page,$perpage,$site,$searchTitle,$sort_by);

$testvvv = "10";
$minwords = "55";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>Themegatee Schedule Product</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<link rel="icon" href="/favicon.png" type="image/x-icon">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>

.masthead {
  height: 100vh;
  min-height: 500px;
  background-size: 1000px 1000px;
  background-position: center;
  background-repeat: no-repeat;
  padding-top: 45px;
}

.custom-checkbox {
            width: 14px;
            height: 14px;
}
.table th, .table td {
    vertical-align: middle;
}
.table tbody tr:hover {
    background-color: #f2f2f2;
}
#checkAll {
    cursor: pointer;
}
.itemCheckbox {
    cursor: pointer;
}
.zoomsss {
  transition: transform .1s;
  margin: 0 auto;
}

.zoomsss:hover {
  transform: scale(3.5);
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
      <div class="container-fluid" style="padding:30px;">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true" onclick="return false;">Draft product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false" onclick="return false;">Schedule product</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent" style="padding:20px">
            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                <div class="col-12" id="dataProducts">
                  <table class="table" id="listdraftProducts">
                    <thead>
                      <tr>
                        <th><input type="checkbox" id="checkAll"/></th>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                      </tr>
                    </thead>
                    <tbody>

              <?php 
                $prz=0;
                while($prz<count($g10)){
                  $imgprt = $g10[$prz]->images[0]->src;
              ?> 

                      <tr>
                        <td><input type="checkbox" class="itemCheckbox custom-checkbox" id="checkProduct-<?php echo $g10[$prz]->id;?>"/></td>
                        <td><?php echo $g10[$prz]->id ?></td>
                        <td>
                          <?php echo $g10[$prz]->name?>
                        </td>
                        <td>
                          <div class="zoomsss"><img id="img<?php echo $g10[$prz]->id;?>" src="<?php echo $imgprt ?>" class="img-fluid img-thumbnail" width="100px"></div>
                          
                        </td>

                      </tr>
              <?php 
                $prz++;
              }
              ?>
                    </tbody>
                  </table>    
                  </div>
                

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

            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                <h3>Tab 2 Content</h3>
                <p>This is the content of Tab 2.</p>
            
            </div>
        </div>
    </div>

      
      
      </div>
    </div>




  <script type="text/javascript">
    
    $( document ).ready(function() {
        document.getElementById("searchTitle").value = "<?php echo $searchTitle?>";
        document.getElementById("searchPage").value = "<?php echo $page?>";
        document.getElementById("searchPerPage").value = "<?php echo $perpage?>";
        document.getElementById("select_sort_by").value = "<?php echo $sort_by?>";
    });

    document.getElementById('checkAll').addEventListener('change', function (e) {
        var checkboxes = document.querySelectorAll('.itemCheckbox');
        for (var checkbox of checkboxes) {
            if (checkbox.id.startsWith('checkProduct')) {
                checkbox.checked = e.target.checked;
            }
        }
    });

    function clickSubmit(){
        let searchPage = document.getElementById("searchPage").value;
        let searchTitle = document.getElementById("searchTitle").value;
        let searchPerPage = document.getElementById("searchPerPage").value;

        let selectSortby = document.getElementById("select_sort_by");
        let selectedSortbyValue = selectSortby.value;

        //alert(searchPerPage);
        //getPrducts(searchPage,searchPerPage,searchTitle);
        window.location.href = '/PJ2/themegatee-schedule-product.php?page=' + searchPage + '&perpage='+ searchPerPage + '&sort_by='+ selectedSortbyValue +'&searchTitle='+ searchTitle;
    }
  </script>

</body>
</html>