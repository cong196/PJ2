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
  $prds = $woocommerce->get('products/?status=draft&orderby=date&order=asc&page='.$pg.'&per_page='.$perpage . '&search='. $searchTitle);
    return $prds;
};

$g10 = getProducts($page,$perpage,$site,$searchTitle);
$list = getdataCategory($curPageName);
$someArray = json_decode($list, true);

$listTag = getdataTag($curPageName);

$listTag2 = json_decode($listTag, true);

$testvvv = "10";

?>

<!-- <script src="http://code.jquery.com/jquery-latest.js"></script> -->

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
 -->

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="/PJ2/gendescription.js"></script>
<script type="text/javascript" src="/PJ2/updateProduct.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="/PJ2/updateProductDraft.js"></script>
<script type="text/javascript" src="/PJ2/deleteProduct.js"></script>


<script>
    function getPrducts($page,$perage,$searchTitle) {
        //var query_parameter = document.getElementById("name").value;
        //var dataString = 'parameter=' + query_parameter;
        var ss = window.location.pathname.substring(10);
        //console.log(ss);
        $.ajax({
            type: "POST",
            url: "getEditProduct.php",
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
  function pregenDes($id, $curPageName){
    var customprompt = $('#editprompt-' + $id).val();
    var edtKeywords = $('#edtKeyword-' + $id).val();
    var title = $('#txttitle-' + $id).val();
    var tt = title.replace(/[^a-zA-Z ]/g, "");
    var url =  $('#img' + $id).prop('src');
    var selectmainCategory = $('#mainCategory-' + $id).val();
    var selectmainCategory2 = selectmainCategory.toString();
    var slug = $('#txtslug-' + $id).val();
    var edttitle = $('#edtTitle-' + $id).val();

    var element = document.getElementById('img2-' + $id);
    var img2 = '';
    if(element){
      img2 = $('#img2-' + $id).prop('src');
    }

    generateDescription(tt,$id,customprompt,url,edtKeywords,selectmainCategory2,$curPageName,slug,edttitle,img2);
  }

  function deleteProduct($idtext) {
    /*var table = document.getElementById("listdraftProducts");
    table.deleteRow(1);*/
    //var values = $idtext.split('-');
    //var btnDelete = document.getElementById(values[0]);
    var output = $idtext.replace('del', '');

    var element = document.getElementById('btnYesDel-' + output);
    if(getComputedStyle(element).getPropertyValue('display') == 'none') {
        element.style.display = 'flex';
    } else {
        element.style.display = 'none';
    }
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
          <th scope="col">Category</th>
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
            <br/>
            <strong>slug</strong>
            <textarea class="form-control" id="txtslug-<?php echo $g10[$prz]->id; ?>" rows="2"><?php echo $g10[$prz]->name?></textarea>

          </td>
          <td>
            <div class="zoomsss"><img id="img<?php echo $g10[$prz]->id;?>" src="<?php echo $imgprt ?>" class="img-fluid img-thumbnail" width="100px"></div>
            <br/>
            <?php 
              if(count($g10[$prz]->images) == 1) {
                ?>
              <?php
              } else {
                ?>
                <div class="zoomsss"><img id="img2-<?php echo $g10[$prz]->id;?>" src="<?php echo $g10[$prz]->images[1]->src ?>" class="img-fluid img-thumbnail" width="100px"></div>
            <?php }
            ?>
            
          </td>
          <td>
            <textarea id="content-<?php echo $g10[$prz]->id ?>" name="content" class="ckeditor" cols="70" rows="2"><?php echo $g10[$prz]->description; ?></textarea>
          </td>
          <td>
            <textarea class="form-control" id="editprompt-<?php echo $g10[$prz]->id; ?>" rows="3"></textarea>
            <br/>
            <textarea class="form-control" id="edtKeyword-<?php echo $g10[$prz]->id; ?>" rows="1" placeholder="Keyword"></textarea>
            <br/>
            <select id="mainCategory-<?php echo $g10[$prz]->id;?>" class="form-control selectpicker" multiple data-live-search="true">
              <?php 
                  $index = 0;
                  while($index < count($someArray)) {
              ?>
                <option value="<?php echo $someArray[$index]["id"] ?>"><?php echo $someArray[$index]["name"] ?></option>
              <?php
                  $index++;
                  }
              ?>
              </select>
              
              <br/>
            <br/>
            <textarea class="form-control" id="edtTitle-<?php echo $g10[$prz]->id; ?>" rows="1"></textarea>

          </td>
          <td><button onclick="pregenDes(<?php echo $g10[$prz]->id . ",'". $curPageName. "'" ;?>)" type="button" style="display:flex" id="gendes-<?php echo $g10[$prz]->id;?>"class="btn btn-secondary btn-sm">New des</button>

              <div style="display:none" class="spinner-border spinner-border-sm" id="gendes-<?php echo $g10[$prz]->id; ?>loading" role="status"><span class="sr-only"></span> </div>

          </td>
          <td>
            <select id="selectCategoryyy-<?php echo $g10[$prz]->id;?>" class="form-control selectpicker" multiple data-live-search="true">
              <?php 
                  $index = 0;
                  while($index < count($someArray)) {
              ?>
                <option value="<?php echo $someArray[$index]["id"] ?>"><?php echo $someArray[$index]["name"] ?></option>
              <?php
                  $index++;
                  }
              ?>
              </select>
              <br/>
              <br/>
              <b>Tag</b><br/>
              <select id="listTag-<?php echo $g10[$prz]->id;?>" class="form-control selectpicker" multiple data-live-search="true">
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

              <br/>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="radPublish-<?php echo $g10[$prz]->id;?>">
                <label class="form-check-label" for="radPublish-<?php echo $g10[$prz]->id;?>">
                  Publish
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="radDefault-<?php echo $g10[$prz]->id;?>" checked>
                <label class="form-check-label" for="radDefault-<?php echo $g10[$prz]->id;?>">
                  Default
                </label>
              </div>

          </td>
          <td><?php echo $g10[$prz]->price ?></td>
        
          <td>
             <button onclick="updateProductDraft(<?php echo $g10[$prz]->id . ",'". $curPageName . "'" ;?>)" type="button" style="display:flex" id="saveinfo-<?php echo $g10[$prz]->id;?>"class="btn btn-secondary btn-sm">Save</button>

              <div style="display:none" class="spinner-border spinner-border-sm" id="saveinfo-<?php echo $g10[$prz]->id; ?>loading" role="status"><span class="sr-only"></span> </div>
              <br/>
              <button onclick="deleteProduct(<?php echo "'".$g10[$prz]->id .'-'. $prz. "'"?>)" type="button" id="delete-<?php echo $g10[$prz]->id . '-'. $prz;?>"class="btn btn-danger btn-sm">Delete</button><br/><p></p>


              <button style="display:none" onclick="jsProduct(this,<?php echo "'".$curPageName."'" ?>,<?php echo "'".$g10[$prz]->id .'-'. $prz. "'"?>)" type="button" id="btnYesDel-<?php echo $g10[$prz]->id . '-'. $prz;?>"class="btn btn-danger btn-sm">Yes</button>

              <div style="display:none" class="spinner-border spinner-border-sm" id="savedelete-<?php echo $g10[$prz]->id . '-'. $prz;?>loading" role="status"><span class="sr-only"></span> </div>

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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>