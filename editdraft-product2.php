<?php

use Automattic\WooCommerce\Client;
require __DIR__ . '/vendor/autoload.php';

include "dbConnect.php";
include "config.php";
include "getDatastore.php";
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);


$page = $_GET['page'];
settype($page, "int");

$perpage = $_GET['perpage'];
settype($perpage, "int");

$searchTitle = $_GET['searchTitle'];

$site = json_decode(getKey($curPageName));



$g10 = getProducts($page,$perpage,$site,$searchTitle);

$testvvv = "10";
$minwords = "55";
?>


<script src="https://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="/PJ2/gendescription.js"></script>
<script type="text/javascript" src="/PJ2/updateProduct.js"></script>



<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">




<!-- Bootstrap Select (if needed) -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">

<!-- Bootstrap JS
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script> -->

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript" src="/PJ2/updateProductDraft.js"></script>
<script type="text/javascript" src="/PJ2/deleteProduct.js"></script>
<style>
    /* Custom CSS for the floating button and dragging */
    .floating-button {
      position: fixed;
      bottom: 150px;
      right: 50px;
      z-index: 9999;
      cursor: pointer;
      transition: opacity 0.3s;
    }

    .floating-button:active {
      cursor: grabbing; /* Set cursor to grabbing when button is being dragged */
    }

  </style>
<style>
    .list-group1 {
      list-style-type: none;
      padding: 0;
    }

    .list-item1 {
      position: relative;
      padding: 7px;
      background-color: #f0f0f0;
      border: 1px solid #ccc;
      margin: 5px 0;
      border-radius: 3px;
      display: inline-flex;
      align-items: center;
      cursor: pointer;
    }

    .selected1 {
          border: 2px solid blue;
      }

    .label1 {
      text-align: right;
      margin-right: 10px;
      white-space: nowrap;
      font-size: 0.8rem;
    }

    .delete-button {
      background-color: #f44336;
      color: white;
      border: none;
      cursor: pointer;
      width: 15px; /* Reduced width */
      height: 15px; /* Reduced height */
      font-size: 0.7rem; /* Smaller font size for the "X" */
      text-align: center; /* To horizontally center the "X" */
      border-radius: 0 3px 0 3px; /* Keep it as a circle */
      position: absolute;
      top: 0px;
      right: 0px;
      padding: 0; /* Reset padding */
      display: flex; /* Use flexbox for centering */
      align-items: center; /* Vertically center the content */
      justify-content: center; /* Horizontally center the content */

    }
    .editable {
      display: none;
    }
    input.editable {
      border: none; /* Remove the default border */
      outline: none; /* Remove the outline when focused */
      padding: 0; /* Remove padding */
      margin: 0; /* Remove margin */
      background-color: #f0f0f0;
    }

  </style>

<script type="text/javascript">
  function pregenDes($id, $curPageName){
    
    var title = $('#txttitle-' + $id).val();
    var tt = title.replace(/[^a-zA-Z0-9 ]/g, "");
    var url =  $('#img' + $id).prop('src');
    var slug = $('#txtslug-' + $id).val();
    var element = document.getElementById('img2-' + $id);
    var img2 = '';
    var is_add_related = 0;
    var is_add_homepage = 0;
    if(element){
      img2 = $('#img2-' + $id).prop('src');
    }
    var tags = getSelectedText($id);

    //console.log(tags);
    var storedValue1 = $('#customRange' + $id).val();
    var storedValueModel1 = 1;
    if($('#radioModeldavinci003' + $id).prop('checked')) {
      storedValueModel1 = 1;
    } else {
      if($('#radioModel35tubo' + $id).prop('checked')) {
        storedValueModel1 = 2;
      } else {

      }
    }
    
    if($('#check_is_add_related_product_' + $id).prop('checked')) {
      is_add_related = 1;
    }

    if($('#check_is_add_homepage_url_' + $id).prop('checked')) {
      is_add_homepage = 1;
    }

    $('#gendes-' + $id+'-loading').css('display', 'flex');
    $('#gendes-' + $id).css('display', 'none');

    $.ajax({
        type: "POST",
        url: "gen_des.php",
        data: {title:tt, id:$id, page_name:$curPageName, minimum_words:storedValue1, model_GPT:storedValueModel1, tags:tags,is_add_related:is_add_related, is_add_homepage:is_add_homepage },
        cache: false,
        success: function(data) {
          $('#gendes-' + $id+'-loading').css('display', 'none');
          $('#gendes-' + $id).css('display', 'flex');
            /*var data1 = CKEDITOR.instances['content-'+$id].getData();
            data1 = data1.replace(/{title}/g, title);
            var parts = data.split("BD0011");
            var contentDescription = '';*/
            
            /*if (parts[1] !== undefined && parts[1] !== null && parts[1] !== "") {
                  contentDescription = parts[0] + '<img class="aligncenter" title="' + title + '" src=" '+ url +' " alt="' + title + '" width="600" />' +  data1 + '<p>' + parts[1] + '</p>';
              } else {
                  contentDescription = parts[0] + '<img class="aligncenter" title="' + title + '" src=" '+ url +' " alt="' + title + '" width="600" />' +  data1;
              }*/
              
            /*if(img2 == '') {
              if (parts[1] !== undefined && parts[1] !== null && parts[1] !== "") {
                  contentDescription = parts[0] + '<img class="aligncenter" title="' + title + '" src=" '+ url +' " alt="' + title + '" width="600" />' +  data1 + '<p>' + parts[1] + '</p>';
              } else {
                  contentDescription = parts[0] 
                + '<img class="aligncenter" title="' + title + '" src="' + urlimg + '" alt="' + slug + '" width="600" /><br/>' + data1;
              }
             } else {
                if (parts[1] !== undefined && parts[1] !== null && parts[1] !== "") {
                  contentDescription = parts[0] + '<img class="aligncenter" title="' + title + '" src=" '+ url +' " alt="' + title + '" width="600" /><br/>'
                    + '<img class="aligncenter" title="' + title + '"src=" '+ img2 +' " alt="' + title + '" width="600" />' +  data1';
                } else {
                  contentDescription = parts[0] 
                + '<img class="aligncenter" title="' + title + '" src="' + urlimg + '" alt="' + slug + '" width="600" /><br/>'
                + '<img class="aligncenter" title="' + title + '" src="' + img2 + '" alt="' + slug + '" width="600" />' 
                + data1;
                }
             }*/
             
            var data1 = CKEDITOR.instances['content-' + $id].getData();
            data1 = data1.replace(/{title}/g, title);
            
            var parts = data.split("BD0011");
            var contentDescription = '';
            
            if (img2 == '') {
                if (parts[1] !== undefined && parts[1] !== null && parts[1] !== "") {
                    contentDescription = parts[0] + '<img class="aligncenter" title="' + title + '" src="' + url + '" alt="' + title + '" width="600" />' + data1 + '<p>' + parts[1] + '</p>';
                } else {
                    contentDescription = parts[0] 
                    + '<img class="aligncenter" title="' + title + '" src="' + url + '" alt="' + slug + '" width="600" /><br/>' + data1;
                }
            } else {
                if (parts[1] !== undefined && parts[1] !== null && parts[1] !== "") {
                    contentDescription = parts[0] 
                    + '<img class="aligncenter" title="' + title + '" src="' + url + '" alt="' + title + '" width="600" /><br/>'
                    + '<img class="aligncenter" title="' + title + '" src="' + img2 + '" alt="' + title + '" width="600" />' + data1 + '<p>' + parts[1] + '</p>';
                } else {
                    contentDescription = parts[0] 
                    + '<img class="aligncenter" title="' + title + '" src="' + url + '" alt="' + slug + '" width="600" /><br/>'
                    + '<img class="aligncenter" title="' + title + '" src="' + img2 + '" alt="' + slug + '" width="600" />' 
                    + data1;
                }
            }


            while (contentDescription.includes("<p></p>") || contentDescription.includes("<p><p>") || contentDescription.includes("</p></p>") ) {
                contentDescription = contentDescription.replace("<p></p>", "");
                contentDescription = contentDescription.replace("<p><p>", "<p>");
                contentDescription = contentDescription.replace("</p></p>", "</p>");
            }
            CKEDITOR.instances['content-'+$id].setData(contentDescription);
            saveProduct($id,$curPageName);
      }
    });
    //saveProduct($id,$curPageName);
  }

  function saveProduct($id, $page_name) {

    $('#saveinfo-' + $id+'loading').css('display', 'flex');
    $('#saveinfo-' + $id).css('display', 'none');

    var id = $id;
    var site = $page_name;
    var description = CKEDITOR.instances['content-'+id].getData();
    var title = $('#txttitle-' + id).val();
    var slug = $('#txtslug-' + id).val();
    var price = $('#txtinputprice-' + id).val();
    var tags = getSelectedText($id);
    var publish = 0;
    if(document.getElementById('radPublish-'+id).checked) {
           publish = 1;
    }else if(document.getElementById('radDefault-'+id).checked) {
           publish = 0;
    }


    $.ajax({
      type: "POST",
      url: "save_draft_product.php",
      data: {id:id, site:site, description:description, title:title, slug:slug, price:price, publish:publish,tags:tags},
      cache: false,
      success: function(html) {
        console.log(html);
        $('#saveinfo-' + id+'loading').css('display', 'none');
        $('#saveinfo-' + id).css('display', 'flex');
      }
    });
  }
  function deleteProduct($idtext) {
    var output = $idtext.replace('del', '');
    var element = document.getElementById('btnYesDel-' + output);
    if(getComputedStyle(element).getPropertyValue('display') == 'none') {
        element.style.display = 'flex';
    } else {
        element.style.display = 'none';
    }
  }
  function deleteRow($btn,$id) {
    var row = $btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
  }

  function removeSpan(button) {
      var listItem = button.parentElement;
      listItem.remove();
    }

  function toggleBorder(listItem) {
    listItem.classList.toggle("selected1");
  }
  
  function getSelectedText(id) {
      var listId = "list_Tag_" + id;
      var selectedItems = document.querySelectorAll(`#${listId} .list-item1.selected1`);
      var selectedText = "";
      selectedItems.forEach(function(item, index) {
        var label = item.querySelector(".label1");
        var labelText = label.textContent.trim();
        if (index !== 0) {
          selectedText += ","; // Add a comma and space after the first label
        }
        selectedText += labelText;
      });
      //document.getElementById("selectedText").textContent = selectedText;
      return selectedText;
  }


</script>

<style>
.zoomsss {
  transition: transform .1s; /* Animation */
  margin: 0 auto;
}

.zoomsss:hover {
  transform: scale(5.5);
}
</style>
<div class="floating-button">
    <button class="btn btn-info" onclick="showModalSetting()"><i class="fa-solid fa-gear"></i></button>
</div>

<!-- Small Modal -->
<div class="modal fade" id="modalSettings" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Setting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <b>Model</b>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="group5" id="radioModeldavinci003all" value="radioModeldavinci003all" checked>
                <label class="form-check-label" for="radioModeldavinci003all">
                  text-davinci-003
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="radio" name="group5" id="radioModel35tuboall" value="radioModel35tuboall">
                <label class="form-check-label" for="radioModel35tuboall">
                  gpt-3.5-turbo
                </label>
              </div>
              <br/>
              <label for="customRange3" class="form-label">Minimum words</label>
              <input type="range" class="form-range" value="<?php echo isset($_COOKIE['customRange3']) ? $_COOKIE['customRange3'] : $minwords; ?>" min="50" max="150" step="1" id="customRange3" oninput="showVal(this.value)" onchange="showVal(this.value)">
              <span>Value: </span><span id="valBox"><?php echo $minwords ?></span>

              <br/>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="setting_add_related_product">
                <label class="form-check-label" for="setting_add_related_product">
                  Add related product?
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="setting_add_homepage_url">
                <label class="form-check-label" for="setting_add_homepage_url">
                  Add URL home page?
                </label>
              </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="clickSave()" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



<div class="w-100 p-3">
  <div class="row">

    <div class="col-12" id="dataProducts">
    <table class="table table-image" id="listdraftProducts">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Title</th>
          <th scope="col">Image</th>
          <th scope="col">Description</th>
          <th scope="col">Suggest tags</th>
          <th scope="col"></th>
          <th scope="col">Category</th>
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
          <td scope="row">
            <textarea class="form-control" id="txttitle-<?php echo $g10[$prz]->id; ?>" rows="1"><?php echo $g10[$prz]->name?></textarea>
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
          <td style="width: 200px;">
            <ul class="list-group1" id="list_Tag_<?php echo $g10[$prz]->id ?>">
                
                <?php 
                  $indx2 = 0;
                  while($indx2 < count($g10[$prz]->tags)) {
                ?>
                  <li class="list-group-item list-item1" onclick="toggleBorder(this)" ondblclick="editLabel(this)">
                    <span class="label1"><?php echo $g10[$prz]->tags[$indx2]['name']?></span>
                    <input type="text" class="editable" onblur="saveLabel(this)" />
                    <button class="delete-button" onclick="removeSpan(this)">x</button>
                  </li>
                <?php
                   $indx2++;
                 }
                ?>
              </ul>
          </td>
          <td>


              <b>Model</b>
              
               <div class="form-check">
                <input class="form-check-input" type="radio" name="group<?php echo $g10[$prz]->id?>" id="radioModeldavinci003<?php echo $g10[$prz]->id?>" value="option2" checked>
                <label class="form-check-label" for="radioModeldavinci003<?php echo $g10[$prz]->id?>">
                  text-davinci-003
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="radio" name="group<?php echo $g10[$prz]->id?>" id="radioModel35tubo<?php echo $g10[$prz]->id?>" value="option1">
                <label class="form-check-label" for="radioModel35tubo<?php echo $g10[$prz]->id?>">
                  gpt-3.5-turbo
                </label>
              </div>

              <br/>
              <span>Minimum words</span><br/>
              <input style="width: 100px;" type="range" class="form-range" value=60 min="50" max="150" step="1" id="customRange<?php echo $g10[$prz]->id?>" oninput="showValRangeId(this.value,<?php echo $g10[$prz]->id?>)" onchange="showValRangeId(this.value,<?php echo $g10[$prz]->id?>)">
              <br/>
              <span>Value: </span><span id="valBox<?php echo $g10[$prz]->id?>"><?php echo $minwords ?></span>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="check_is_add_related_product_<?php echo $g10[$prz]->id; ?>">
                <label class="form-check-label" for="check_is_add_related_product_<?php echo $g10[$prz]->id; ?>">
                  Add related product?
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="check_is_add_homepage_url_<?php echo $g10[$prz]->id; ?>">
                <label class="form-check-label" for="check_is_add_homepage_url_<?php echo $g10[$prz]->id; ?>">
                  Add homepage url?
                </label>
              </div>

              <br/>
              <button onclick="pregenDes(<?php echo $g10[$prz]->id . ",'". $curPageName. "'" ;?>)" type="button" style="display:flex" id="gendes-<?php echo $g10[$prz]->id;?>"class="btn btn-secondary btn-sm">New des</button>
              <div style="display:none" class="spinner-border spinner-border-sm" id="gendes-<?php echo $g10[$prz]->id; ?>-loading" role="status"><span class="sr-only"></span> </div>

          </td>
          <td>
           
              <div class="mb-3 row">
                <label for="txtinputprice-<?php echo $g10[$prz]->id ?>" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-10">
                  <input id="txtinputprice-<?php echo $g10[$prz]->id ?>" class="form-control" style="width: 80px;" value="<?php echo $g10[$prz]->price ?>">
                </div>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="radio" name="groupPub<?php echo $g10[$prz]->id?>" id="radPublish-<?php echo $g10[$prz]->id;?>" checked>
                <label class="form-check-label" for="radPublish-<?php echo $g10[$prz]->id;?>">
                  Publish
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="groupPub<?php echo $g10[$prz]->id?>" id="radDefault-<?php echo $g10[$prz]->id;?>">
                <label class="form-check-label" for="radDefault-<?php echo $g10[$prz]->id;?>">
                  Default
                </label>
              </div>

          </td>
          <!-- <td><?php echo $g10[$prz]->price ?>
            
            <br/>
            <input class="form-control form-control-sm" style="width: 60px;" value="<?php echo $g10[$prz]->price ?>">

          </td> -->
          <td>
            
             <button onclick="saveProduct(<?php echo $g10[$prz]->id . ",'". $curPageName . "'" ;?>)" type="button" style="display:flex" id="saveinfo-<?php echo $g10[$prz]->id;?>"class="btn btn-secondary btn-sm">Save</button>

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

<script>

  

  $(document).ready(function() {
    let isDragging = false;
    let offset = { x: 0, y: 0 };

    // Mouse down event to start dragging
    $('.floating-button').on('mousedown', function(event) {
      isDragging = true;
      offset.x = event.clientX - parseInt($('.floating-button').css('left'));
      offset.y = event.clientY - parseInt($('.floating-button').css('top'));
    });

    // Mouse move event for dragging
    $(document).on('mousemove', function(event) {
      if (isDragging) {
        $('.floating-button').css({
          top: event.clientY - offset.y,
          left: event.clientX - offset.x
        });
      }
    });

    // Mouse up event to stop dragging
    $(document).on('mouseup', function() {
      isDragging = false;
    });

  });

  function showVal(newVal){
    document.getElementById("valBox").innerHTML=newVal;
  }
  function showValRangeId(newVal,id){
    document.getElementById("valBox" + id).innerHTML=newVal;
  }

  $('#modalSettings').on('show.bs.modal', function (e) {
      const storedValue = localStorage.getItem('customRange3');
      if (storedValue !== null) {
        document.getElementById('customRange3').value = storedValue;
        showVal(storedValue);
      } else {
          localStorage.setItem('customRange3', '60');
          document.getElementById('customRange3').value = 60;
          showVal(60);
      }

      const customKeywordswitch = localStorage.getItem('customKeywordswitch');
      if (customKeywordswitch !== null) {
        if(customKeywordswitch =='true') {
            $('#settingflexSwitchKeyword').prop('checked', true);
        } else {
            $('#settingflexSwitchKeyword').prop('checked', false);
        }
      } else {
          localStorage.setItem('customKeywordswitch', 'false');
          $('#settingflexSwitchKeyword').prop('checked', false);
      }

      const savecustomKeywordswitch = localStorage.getItem('savecustomKeywordswitch');
      if (savecustomKeywordswitch !== null) {
        if(savecustomKeywordswitch =='true') {
            $('#settingflexSwitchSaveKeyword').prop('checked', true);
        } else {
            $('#settingflexSwitchSaveKeyword').prop('checked', false);
        }
      } else {
          localStorage.setItem('savecustomKeywordswitch', 'false');
          $('#settingflexSwitchSaveKeyword').prop('checked', false);
      }

      const is_add_related = localStorage.getItem('is_add_related');
      if (is_add_related !== null) {
        if(is_add_related =='true') {
            var checkbox_setting_related = document.getElementById("setting_add_related_product");
            checkbox_setting_related.checked = true;
        } else {
            var checkbox_setting_related = document.getElementById("setting_add_related_product");
            checkbox_setting_related.checked = false;
        }
      } else {
          localStorage.setItem('is_add_related', 'false');
          var checkbox_setting_related = document.getElementById("setting_add_related_product");
          checkbox_setting_related.checked = false;
      }

      const is_add_homepage = localStorage.getItem('is_add_homepage');
      if (is_add_homepage !== null) {
        if(is_add_homepage =='true') {
            var checkbox_add_home_page = document.getElementById("setting_add_homepage_url");
            checkbox_add_home_page.checked = true;
        } else {
            //$('#setting_add_homepage_url').prop('checked', false);
            var checkbox_add_home_page = document.getElementById("setting_add_homepage_url");
            checkbox_add_home_page.checked = false;
        }
      } else {
          localStorage.setItem('is_add_homepage', 'false');
          var checkbox_add_home_page = document.getElementById("setting_add_homepage_url");
          checkbox_add_home_page.checked = false;
      }

      /*document.getElementById("customRange3").value= <?php echo $minwords ?>;
      showVal(<?php echo $minwords ?>);*/
    //alert(<?php echo $minwords ?>);
  })

  window.onload = function() {
    const storedValue = localStorage.getItem('customRange3');
    const storedValueModel = localStorage.getItem('ValueModel');
    const customKeywordswitch = localStorage.getItem('customKeywordswitch');
    const savecustomKeywordswitch = localStorage.getItem('savecustomKeywordswitch');
    const is_add_related = localStorage.getItem('is_add_related');
    const is_add_homepage = localStorage.getItem('is_add_homepage');

    if (customKeywordswitch !== null) {
        if(customKeywordswitch == 'true') {
            $('#settingflexSwitchKeyword').prop('checked', true);
        } else {
            $('#settingflexSwitchKeyword').prop('checked', false);
        }
    } else {
        localStorage.setItem('customKeywordswitch', 'false');
        $('#settingflexSwitchKeyword').prop('checked', false);
    }

    if (savecustomKeywordswitch !== null) {
        if(savecustomKeywordswitch == 'true') {
            $('#settingflexSwitchSaveKeyword').prop('checked', true);
        } else {
            $('#settingflexSwitchSaveKeyword').prop('checked', false);
        }
    } else {
        localStorage.setItem('savecustomKeywordswitch', 'false');
        $('#settingflexSwitchSaveKeyword').prop('checked', false);
    }

    if (is_add_related !== null) {
      if(is_add_related =='true') {
          $('#setting_add_related_product').prop('checked', true);
      } else {
          $('#setting_add_related_product').prop('checked', false);
      }
    } else {
        localStorage.setItem('is_add_related', 'false');
        $('#setting_add_related_product').prop('checked', false);
    }

    if (is_add_homepage !== null) {
      if(is_add_homepage =='true') {
          $('#setting_add_homepage_url').prop('checked', true);
      } else {
          $('#setting_add_homepage_url').prop('checked', false);
      }
    } else {
        localStorage.setItem('is_add_homepage', 'false');
        $('#setting_add_homepage_url').prop('checked', false);
    }

    if (storedValue !== null) {
        document.getElementById('customRange3').value = storedValue;
        saveSettings();
    } else {
        localStorage.setItem('customRange3', '60');
        document.getElementById('customRange3').value = 60;
        /*document.getElementById('customRange3').value = storedValue;
        showVal(storedValue);*/
        saveSettings();
    }

    if(storedValueModel !== null) {
        if(storedValueModel == 1) {
            const radioDavinciElements = document.querySelectorAll('input[id*="radioModeldavinci003"]');
            for (const radioDavinci of radioDavinciElements) {
                  radioDavinci.checked = true;
            }
        } else {
            if(storedValueModel == 2) {
              const radioModel35tuboElements = document.querySelectorAll('input[id*="radioModel35tubo"]');
              for (const radioModel35tubo of radioModel35tuboElements) {
                    radioModel35tubo.checked = true;
              }
            } else {

            }
      }
    } else {
      localStorage.setItem('ValueModel', '1');
      const radioDavinciElements = document.querySelectorAll('input[id*="radioModeldavinci003"]');
      for (const radioDavinci of radioDavinciElements) {
            radioDavinci.checked = true;
      }
    }
  };

function saveModel(){
    const storedValueModel = localStorage.getItem('ValueModel');
    //alert("saveModel: " + storedValueModel);
    if(storedValueModel == 1) {
          const radioDavinciElements = document.querySelectorAll('input[id*="radioModeldavinci003"]');
          for (const radioDavinci of radioDavinciElements) {
                radioDavinci.checked = true;
          }
      } else {
          if(storedValueModel == 2) {
            const radioModel35tuboElements = document.querySelectorAll('input[id*="radioModel35tubo"]');
            for (const radioModel35tubo of radioModel35tuboElements) {
                  radioModel35tubo.checked = true;
            }
          } else {

          }
    }
}
function checkModel() {
    const radioInput = document.getElementById('radioModeldavinci003all');
    if (radioInput.checked) {
        localStorage.setItem('ValueModel', '1');
        saveModel();
    } else {
      const radioInput2 = document.getElementById('radioModel35tuboall');
      if (radioInput2.checked) {
        localStorage.setItem('ValueModel', '2');
        saveModel();
      } else {

      }
    }
}
function saveSettings() {
    const currentValue = document.getElementById('customRange3').value;
    localStorage.setItem('customRange3', currentValue);
    const inputElements = document.querySelectorAll('input[id*="customRange"]');
    for (const input of inputElements) {
          input.value = currentValue;
    }
    const spanElements = document.getElementsByTagName("span");
    for (let i = 0; i < spanElements.length; i++) {
        const span = spanElements[i];
        const id = span.getAttribute("id");
        
        if (id && id.includes("valBox")) {
            span.textContent = currentValue;
        }
    }
    var switchkeyword = $('#settingflexSwitchKeyword');
    if (switchkeyword.length > 0) {
        if (switchkeyword.prop('checked')) {
            //console.log('SAVE TRUE');
            localStorage.setItem('customKeywordswitch', 'true');
            const checkboxes = document.querySelectorAll('[id^="switchkeyword-"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });

            const textInputs = document.querySelectorAll('[id^="edtKeyword-"]');
            const divs = document.querySelectorAll('[id^="selectedKeywords-"]');
            const divs2 = document.querySelectorAll('[id^="savekeywords-"]');
            const divs3 = document.querySelectorAll('[id^="keywordprops-"]');
            
            textInputs.forEach(input => {
                input.style.display = "flex";
            });
            
            divs.forEach(div => {
                div.style.display = "none";
            });
            divs2.forEach(div => {
                div.style.display = "flex";
            });
            divs3.forEach(div => {
                div.style.display = "flex";
            });

        } else {
            //console.log('SAVE FALSE');
            localStorage.setItem('customKeywordswitch', 'false');
            const checkboxes = document.querySelectorAll('[id^="switchkeyword-"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            const textInputs = document.querySelectorAll('[id^="edtKeyword-"]');
            const divs = document.querySelectorAll('[id^="selectedKeywords-"]');
            const divs2 = document.querySelectorAll('[id^="savekeywords-"]');
            const divs3 = document.querySelectorAll('[id^="keywordprops-"]');
            textInputs.forEach(input => {
                input.style.display = "none";
            });
            
            divs.forEach(div => {
                div.style.display = "flex";
            });
            divs2.forEach(div => {
                div.style.display = "none";
            });
            divs3.forEach(div => {
                div.style.display = "none";
            });
        }
    } else {
      
    }


    var switchsavekeyword = $('#settingflexSwitchSaveKeyword');
    if (switchsavekeyword.length > 0) {
        if (switchsavekeyword.prop('checked')) {
            localStorage.setItem('savecustomKeywordswitch', 'true');
            const checkboxes = document.querySelectorAll('[id^="switchsavekeywords-"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
        } else {
            localStorage.setItem('savecustomKeywordswitch', 'false');
            const checkboxes = document.querySelectorAll('[id^="switchsavekeywords-"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        }
    } else {
      
    }

    var checkbox_add_home_page = document.getElementById("setting_add_homepage_url");
    if (checkbox_add_home_page.checked) {
        localStorage.setItem('is_add_homepage', 'true');
        var checkboxes = document.querySelectorAll('input[type="checkbox"][id*="check_is_add_homepage_url"]');
        checkboxes.forEach(function (checkbox) {
          checkbox.checked = true;
        });
    } else {
        localStorage.setItem('is_add_homepage', 'false');
        var checkboxes = document.querySelectorAll('input[type="checkbox"][id*="check_is_add_homepage_url"]');
        checkboxes.forEach(function (checkbox) {
          checkbox.checked = false;
        });
    }

    var checkbox_add_related_1 = document.getElementById("setting_add_related_product");
    if (checkbox_add_related_1.checked) {
        localStorage.setItem('is_add_related', 'true');
        var checkboxes = document.querySelectorAll('input[type="checkbox"][id*="check_is_add_related_product"]');
        checkboxes.forEach(function (checkbox) {
          checkbox.checked = true;
        });
    } else {
        localStorage.setItem('is_add_related', 'false');
        var checkboxes = document.querySelectorAll('[id*="check_is_add_related_product"]');
        checkboxes.forEach(function(checkbox) {
          checkbox.checked = false;
        });
        /*var checkboxes = document.querySelectorAll('input[type="checkbox"][id*="check_is_add_related_product "]');
        checkboxes.forEach(function (checkbox) {
          checkbox.checked = false;
        });*/
    }

}

  function clickSave(){
    saveSettings();
    checkModel();
    $('#modalSettings').modal('hide');
  }

  function showModalSetting(){
    $('#modalSettings').modal('show');
  }
  function copyToClipboard(text,id) {
    var input = document.createElement('input');
    input.value = text;
    document.body.appendChild(input);
    input.select();
    document.execCommand('copy');
    document.body.removeChild(input);

    var copyLinkText = document.getElementById('copy-'+ id);
    copyLinkText.innerHTML = 'Link Copied!';
    setTimeout(function() {
        copyLinkText.innerHTML = 'Copy Link';
    }, 2000);
  }

  function addTag(){
    $('#addTagmodal').modal('show');
  }

  function editLabel(listItem) {
      const span = listItem.querySelector('.label1');
      const input = listItem.querySelector('.editable');
      span.style.display = 'none';
      input.style.display = 'inline-block';
      input.value = span.textContent;
      input.focus();
    }

    function saveLabel(input) {
      const span = input.previousElementSibling; // Get the previous sibling, which is the <span>
      span.textContent = input.value;
      span.style.display = 'inline-block';
      input.style.display = 'none';
    }

</script>
