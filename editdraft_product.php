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
$minwords = "55";
?>

<!-- <script src="http://code.jquery.com/jquery-latest.js"></script> -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
 -->

<script src="https://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="/PJ2/gendescription.js"></script>
<script type="text/javascript" src="/PJ2/updateProduct.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    //var tt = title.replace(/[^a-zA-Z ]/g, "");
    var tt = title.replace(/[^a-zA-Z0-9 ]/g, "");
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

    const iscustomkeyw = document.getElementById('switchkeyword-'+ $id);
    var selectkeywords = $('#keywords-' + $id + ' option:selected').text();
    var iscustomkeyw1 = "";
    if(iscustomkeyw.checked === true) {
      
    } else {
        edtKeywords = selectkeywords;
    }

    generateDescription(tt,$id,customprompt,url,edtKeywords,selectmainCategory2,$curPageName,slug,edttitle,img2,storedValue1,storedValueModel1);
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

  function loadKeyword($id,$defaltcategory,$curpage){
    var category = $('#mainCategory-' + $id + ' option:selected').text();
    var valCategory = $('#mainCategory-' + $id).val();
    var defaultcategory = $('#selectCategoryyy-' + $id + ' option').filter(function() {
        return $(this).text() === $defaltcategory;
    });

    /*var valueDefalut = defaultcategory.val();
    $('#selectCategoryyy-' + $id).val([valCategory, valueDefalut]);
    $('#selectCategoryyy-' + $id).selectpicker('refresh');
    var selecttag = $('#listTag-' + $id + ' option').filter(function() {
        return $(this).text().toLowerCase() === category.toLowerCase();
    });*/
    
    /*var valuetag = selecttag.val();
    $('#listTag-' + $id).val(valuetag);
    $('#listTag-' + $id).selectpicker('refresh');*/

    $.ajax({
        type: "POST",
        url: "getKeywordCategory.php",
        data: {category:category, id:$id},
        cache: false,
        success: function(html) {
        document.getElementById("selectedKeywords-" + $id).innerHTML=html;
        $('#keywords-' + $id).selectpicker();
      }
    });

    $.ajax({
        type: "POST",
        url: "getURLcategory.php",
        data: {site:$curpage,valCategory:valCategory},
        cache: false,
        success: function(html) {

        //document.getElementById("click-copy-" + $id).innerHTML=clickhtml;
        var paragraph = document.getElementById("click-copy-" + $id);
        paragraph.onclick = function() {
            copyToClipboard(html, $id);
        };
      }
    });


  }

function addtagFunction($site){
    var tag = $('#inputTag').val();
    if(tag.trim() === "") {
        alert("Input cannot be blank!");
        return;
    } else {
      $('#savetag').css('display', 'none');
      $('#savetagloading').css('display', 'flex');
      $.ajax({
        type: "POST",
        url: "addnewTag.php",
        data: {site:$site,tag:tag.trim()},
        cache: false,
        success: function(html) {
            if(html=="0") {
              alert("Tag already exists !");
            } else {
                console.log(html + "\n");
                var dataArray1 = html.split(',');
                var newOption = '<option value="' + dataArray1[0] + '">' + dataArray1[1] + '</option>';
                $('select[id^="listTag-"]').each(function() {
                  $(this).append(newOption);
                  $(this).selectpicker('refresh');
              });
              var messageElement = document.getElementById("successtagtext");
              messageElement.style.display = "block";
              setTimeout(function () {
                  messageElement.style.display = "none";
              }, 2000);
            }
            $('#savetag').css('display', 'flex');
            $('#savetagloading').css('display', 'none');
        }
      });
    }
}

function switchKeywordchange($id){
    var switchweyword = $('#switchkeyword-' + $id);
    if (switchweyword.length > 0) {
        if (switchweyword.prop('checked')) {
          $('#edtKeyword-' + $id).css('display', 'flex');
          $('#selectedKeywords-'+ $id).css('display','none');
          $('#savekeywords-'+$id).css('display','flex');
          $('#keywordprops-'+$id).css('display','flex');
        } else {
          $('#edtKeyword-' + $id).css('display', 'none');
          $('#selectedKeywords-'+ $id).css('display','flex');
          $('#savekeywords-'+$id).css('display','none');
          $('#keywordprops-'+$id).css('display','none');
        }
    } else {
      
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
              <br/>
              <div style="margin-left: 22px;" class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="settingflexSwitchKeyword" checked>
                <label class="form-check-label" for="settingflexSwitchKeyword">Custom keyword</label>
              </div>

              <br/>
              <div style="margin-left: 22px;" class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="settingflexSwitchSaveKeyword" checked>
                <label class="form-check-label" for="settingflexSwitchSaveKeyword ">Save keyword</label>
              </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="clickSave()" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Add Tag modal -->
<div class="modal fade" id="addTagmodal" tabindex="-1" aria-labelledby="addTagmodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTagmodaltitle">Add new tag</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <input type="text" class="form-control" id="inputTag">
       <br/>
       <p id="successtagtext" style="display: none;" class="text-success">Tag add successfully !</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="savetag" type="button" onclick="addtagFunction(<?php echo "'". $curPageName . "'"?>)" class="btn btn-primary">Save changes</button>
        <button id="savetagloading" style="display:none;" class="btn btn-primary" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </button>
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
          <th scope="col">Edit prompt</th>
          <th scope="col"></th>
          <th scope="col">Category</th>
          <!-- <th scope="col">Price</th> -->
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
            <textarea class="form-control" id="txttitle-<?php echo $g10[$prz]->id; ?>" rows="3"><?php echo $g10[$prz]->name?></textarea>
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

            <div style="margin-left: 20px;" class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" onchange="switchKeywordchange(<?php echo $g10[$prz]->id ?>)" id="switchkeyword-<?php echo $g10[$prz]->id ?>">
              <label class="form-check-label" for="switchkeyword-<?php echo $g10[$prz]->id ?>">Custom keyword</label>
            </div>
            
            

            <select data-width="180px" id="mainCategory-<?php echo $g10[$prz]->id;?>" class="form-control selectpicker" onchange="loadKeyword(<?php echo $g10[$prz]->id;?>,<?php echo "'".$g10[$prz]->categories[0]->name."'"; ?>,<?php echo "'". $curPageName ."'" ?>)" data-live-search="true">
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
            
            <div id="click-copy-<?php echo $g10[$prz]->id;?>">
                <p style="cursor: pointer;text-decoration: underline; font-size: 12px;" id="copy-<?php echo $g10[$prz]->id;?>" onclick="copyToClipboard('',<?php echo $g10[$prz]->id;?>)">Copy Category URL</p>
            </div>
            <textarea class="form-control" id="edtKeyword-<?php echo $g10[$prz]->id; ?>" rows="1" placeholder="Keyword"></textarea>
            <div id="selectedKeywords-<?php echo $g10[$prz]->id;?>">
            <select id="keywords-<?php echo $g10[$prz]->id;?>" class="form-control selectpicker" data-live-search="true">

            </select>
            </div>

            <div id="savekeywords-<?php echo $g10[$prz]->id; ?>" style="margin-left: 20px;" class="form-check form-switch">
              <input class="form-check-input form-check-sm" type="checkbox" role="switch" id="switchsavekeywords-<?php echo $g10[$prz]->id ?>" checked>
              <label class="form-check-label" for="switchsavekeywords-<?php echo $g10[$prz]->id ?>">Save keyword</label>
            </div>
            <div style="max-width: 200px;" id="keywordprops-<?php echo $g10[$prz]->id;?>">
              <form>
                  <div class="form-row align-items-center">
                      <div class="col-6">
                          <label class="sr-only" for="txtkeywordvolume-<?php echo $g10[$prz]->id;?>">Input 1</label>
                          <input type="number" class="form-control form-control-sm mb-1" id="txtkeywordvolume-<?php echo $g10[$prz]->id;?>" placeholder="volume(optional)">
                      </div>
                      <div class="col-6">
                          <label class="sr-only" for="txtkeywordtype-<?php echo $g10[$prz]->id;?>">Input 2</label>
                          <input type="text" class="form-control form-control-sm mb-1" id="txtkeywordtype-<?php echo $g10[$prz]->id;?>" placeholder="Type(optional)">
                      </div>
                  </div>
              </form>
            </div>
            <br/>
            <textarea class="form-control" id="edtTitle-<?php echo $g10[$prz]->id; ?>" rows="1"></textarea>

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

              <br/><br/>
              <button onclick="pregenDes(<?php echo $g10[$prz]->id . ",'". $curPageName. "'" ;?>)" type="button" style="display:flex" id="gendes-<?php echo $g10[$prz]->id;?>"class="btn btn-secondary btn-sm">New des</button>
              <div style="display:none" class="spinner-border spinner-border-sm" id="gendes-<?php echo $g10[$prz]->id; ?>loading" role="status"><span class="sr-only"></span> </div>

          </td>
          <td>
            <select data-width="200px" id="selectCategoryyy-<?php echo $g10[$prz]->id;?>" class="form-control selectpicker" multiple data-live-search="true">
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
              <select data-width="200px" id="listTag-<?php echo $g10[$prz]->id;?>" class="form-control selectpicker" multiple data-live-search="true">
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
              <p style="cursor: pointer;text-decoration: underline; font-size: 12px;" id="addtag-<?php echo $g10[$prz]->id;?>" onclick="addTag()">+ Add new tag</p>
              
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
          <!-- <td><?php echo $g10[$prz]->price ?></td> -->
        
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

      /*document.getElementById("customRange3").value= <?php echo $minwords ?>;
      showVal(<?php echo $minwords ?>);*/
    //alert(<?php echo $minwords ?>);
  })

  window.onload = function() {
    const storedValue = localStorage.getItem('customRange3');
    const storedValueModel = localStorage.getItem('ValueModel');
    const customKeywordswitch = localStorage.getItem('customKeywordswitch');
    const savecustomKeywordswitch = localStorage.getItem('savecustomKeywordswitch');

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
</script>
