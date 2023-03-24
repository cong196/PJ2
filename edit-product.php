<?php

use Automattic\WooCommerce\Client;
require __DIR__ . '/vendor/autoload.php';

//include "dbConnect.php";
include "config.php";
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

$page = $_GET['page'];
settype($page, "int");

$perpage = $_GET['perpage'];
settype($perpage, "int");

$searchTitle = $_GET['searchTitle'];

$site = json_decode(getKey($curPageName));


function getProducts($pg, $perpage,$site,$searchTitle){
  $woocommerce = new Client(
        $site->url, 
        $site->ck, 
        $site->cs,
      [
          'version' => 'wc/v3',
      ]
  );

  $prds = $woocommerce->get('products/?page='.$pg.'&per_page='.$perpage . '&search='. $searchTitle);
    return $prds;
};


$g10 = getProducts($page,$perpage,$site,$searchTitle);


$testvvv = "10";

?>

<!-- <script src="http://code.jquery.com/jquery-latest.js"></script> -->

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
 -->

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="/PJ2/updateProduct.js"></script>
<script type="text/javascript" src="/PJ2/gendescription.js"></script>
<script>
    function getPrducts($page,$perage,$searchTitle) {
        //var query_parameter = document.getElementById("name").value;
        //var dataString = 'parameter=' + query_parameter;
        var ss = window.location.pathname.substring(10);
        //console.log(ss);
        $.ajax({
            type: "POST",
            url: "getEditproduct.php",
            data: {page: $page, perage: $perage, searchTitle: $searchTitle, site: ss},
            cache: false,
            success: function(html) {
            // alert(dataString);
            document.getElementById("dataProducts").innerHTML=html;
            //document.getElementById("nextPage").values($page + 1);
            //alert($page + 1);
            }
        });
        return false;
    }
</script>

<script type="text/javascript">
  function pregenDes($id){
    var customprompt = $('#editprompt-' + $id).val();
    var title = $('#txttitle-' + $id).val();
    var tt = title.replace(/[^a-zA-Z ]/g, "");
    var url =  $('#img' + $id).prop('src')
    generateDescription(tt,$id,customprompt,url);
  }

</script>

<style>
.zoomsss {
  transition: transform .1s; /* Animation */
  margin: 0 auto;
}

.zoomsss:hover {
  transform: scale(3.5);
}
</style>

<div class="w-100 p-3">
  <div class="row">


    <div class="col-12" id="dataProducts">
    <table class="table table-image">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Title</th>
          <th scope="col">Image</th>
          <th scope="col">Description</th>
          <th scope="col">Edit prompt</th>
          <th scope="col"></th>
          <th scope="col">Price</th>
          <th scope="col">Save</th>
          <th scope="col">View</th>
        </tr>
      </thead>
      <tbody>

<?php 
  $prz=0;
  while($prz<count($g10)){
    $imgprt = $g10[$prz]->images[0]->src;
?>

        <tr style="vertical-align:initial">
          <td scope="row"><?php echo $g10[$prz]->id ?></td>
          <td scope="row"><textarea class="form-control" id="txttitle-<?php echo $g10[$prz]->id; ?>" rows="1"><?php echo $g10[$prz]->name?></textarea>
          </td>
          <td>
            <div class="zoomsss"><img id="img<?php echo $g10[$prz]->id;?>" src="<?php echo $imgprt ?>" class="img-fluid img-thumbnail" width="100px"></div>
          </td>
          <td>
            <textarea id="content-<?php echo $g10[$prz]->id ?>" name="content" class="ckeditor" cols="70" rows="2"><?php echo $g10[$prz]->description; ?></textarea>
          </td>
          <td><textarea class="form-control" id="editprompt-<?php echo $g10[$prz]->id; ?>" rows="1"></textarea></td>
          <td><button onclick="pregenDes(<?php echo $g10[$prz]->id ; ?>)" type="button" style="display:flex" id="gendes-<?php echo $g10[$prz]->id;?>"class="btn btn-secondary btn-sm">New des</button>

              <div style="display:none" class="spinner-border spinner-border-sm" id="gendes-<?php echo $g10[$prz]->id; ?>loading" role="status"><span class="sr-only"></span> </div>

          </td>
          <td><?php echo $g10[$prz]->price ?></td>
        
          <td>
             <button onclick="updateproducts(<?php echo $g10[$prz]->id . ",'". $curPageName . "'" ;?>)" type="button" style="display:flex" id="saveinfo-<?php echo $g10[$prz]->id;?>"class="btn btn-secondary btn-sm">Save</button>

              <div style="display:none" class="spinner-border spinner-border-sm" id="saveinfo-<?php echo $g10[$prz]->id; ?>loading" role="status"><span class="sr-only"></span> </div>

          </td>
          <td><a href="<?php echo $g10[$prz]->permalink?>" target="_blank"><i class="bi bi-eye"></i></a></td>



        </tr>
       <?php 
       $prz++;
}
?>
      </tbody>
    </table>   
    </div>
  </div>
</div>