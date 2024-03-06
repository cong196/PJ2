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
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

$page = 1;
settype($page, "int");

$nextpage = 1;

$perpage = 10;
settype($perpage, "int");

$searchTxt = "text";

$list = getdataCategory($curPageName);
$someArray = json_decode($list, true);

$listPostcat = getdataPostCategory('themegatee');
$listPostcategory = json_decode($listPostcat, true);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>Themegatee</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="/project1/bootstrap/css/bootstrap.min.css">
<link rel="icon" href="/fav.png" type="image/x-icon">
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
<script src="https://code.jquery.com/jquery-latest.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

<script type="text/javascript" src="/PJ2/gennewposttitle.js"></script>
<script type="text/javascript" src="/PJ2/createPost.js"></script>
<script type="text/javascript" src="/PJ2/generatenewintro.js"></script>
<link rel="stylesheet" href="/PJ2/mystyle.css">
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="/PJ2/custom_css.css">


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
<body>


<?php include 'topbar.php'; ?>
<!-- Bootstrap row -->
<div class="row" id="body-row">
    <!-- Sidebar -->
    <?php include 'slider_bar.php'; ?>
    <!-- sidebar-container END -->
    <!-- MAIN -->
    <div class="col p-4">
        <h2 class="display-4">Viết bài post</h2>
        <div class="w-100 p-3">
  <div class="row">
   <div class="col-4">

      <div class="masthead">
       
  
      <?php include 'themegatee-product.php'; ?>

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


  <div class="col-8">
    
    <div class="masthead">

    <div style="padding-top: 20px;">

    <form class="row g-3">
      <div class="col-7">
        <label for="inputtitlepost" class="visually-hidden">Post title</label>
        <input class="form-control" type="text" id="txtposttitle" placeholder="Post title" aria-label="default input example">
      </div>
      <div class="col-5">
        <button type="button" style="display:flex" class="btn btn-primary mb-3" id="gennewtitlepost" onclick="getPtt()">Generate new title</button>

        <button class="btn btn-primary" style="display:none" id="gennewtitlepost-loading" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...
        </button>


      </div>
  </form>

  <form class="row g-3">
    <div class="col-7">
    <div class="input-group mb-3 col-7">
      <span class="input-group-text" id="txtintroKeyword">Keyword</span>
      <input type="text" class="form-control" id="introKeyword" aria-describedby="basic-addon3">
    </div>
  </div>
    <div class="col-7">
    <select class="form-control selectpicker" id="keywordcategory" data-live-search="true">
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
  </div>
  </form>
<br/>
  <form class="row g-3">
      <div class="col-7">
        <label for="txtintropost">Intro</label>
        <textarea class="ckeditor" id="txtintropost" name="txtintropost" rows="2"></textarea>

      </div>
      <div class="col-5">
        <button type="button" style="display:flex" class="btn btn-primary mb-3" id="gennewIntro" onclick="gennewintro(<?php echo "'".$curPageName."'" ?>)">Generate new intro</button>

        <button class="btn btn-primary" style="display:none" id="gennewIntro-loading" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </button>


      </div>
  </form>
</div>


    <table class="table table-image" id="listAdd">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col"></th>
          <th scope="col">Title</th>
          <th scope="col">Image</th>
          <th scope="col">Price</th>
          <th scope="col">Description</th>
          <th scope="col">New des</th>
          <th scope="col">View</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>   


<div class="d-grid gap-2">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="setDataCheckEdt()">Create Post </button>
</div>


  </div>
</div>

</div>

<!-- Modal -->
<div class="modal fade modal-fullscreen-sm-down" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

          <label for="imgfeaturedinmodal" class="form-label">Featured Image</label>

          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">Upload from URL</span>
            <input type="text" class="form-control" id="imgfeaturedinmodal" aria-describedby="basic-addon3">
          </div>

          <br/>

          <form id="uploadForm" enctype="multipart/form-data">
            <input type="file" id="imageFile" name="imageFile" accept="image/*">
            <button type="submit" id="uploadButton" class="btn btn-primary btn-sm">Upload</button>
            <!-- <div id="loadingIcon" class="d-none">
              <i class="fa fa-spinner fa-spin"></i> Uploading...
            </div> -->
            <div class="spinner-grow spinner-grow-sm d-none" id="loadingIcon" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>

          </form>
          <br/>
          <p>Image ID: <strong id="imageIdUploaded">000</strong>.</p>

          <div class="col-2">
          <p>Post category</p>
          <select class="form-control selectpicker" id="postcategory" multiple data-live-search="true">
                <?php 
                    $index = 0;
                    while($index < count($listPostcategory)) {
                ?>
                  <option value="<?php echo $listPostcategory[$index]["id"] ?>"><?php echo $listPostcategory[$index]["name"] ?></option>
                <?php
                    $index++;
                }
                ?>
          </select>
        </div>

          <label for="desc">Description</label>
          <textarea class="ckeditor" id="desc" name="desc" rows="57"></textarea>

          
        </div>
      <div class="modal-footer">

        <p id="txtResult" style="color:green;display: none;"><b>The post has been created successfully.</b></p>
        <button type="button" class="btn btn-secondary" id="btncloseModal" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary me-md-2" type="button" id="btnCreatePost" <?php echo 'onclick="btncreatePost()"' ?> >Post</button>
          <div class="spinner-border text-primary" id="loading-btnCreatePost" style="display:none" role="status">
            <span class="sr-only"></span>
          </div>

      </div>
    </div>
  </div>
</div>

    </div>
</div>




  <script type="text/javascript">
    

    function clickSubmit(){
        let searchPage = document.getElementById("searchPage").value;
        let searchTitle = document.getElementById("searchTitle").value;
        let searchPerPage = document.getElementById("searchPerPage").value;
        //alert(searchPerPage);
        getPrducts(searchPage,searchPerPage,searchTitle);
    }

    $('#staticBackdrop').on('show.bs.modal', function (event) {
        var button  = $(event.relatedTarget); // Button that triggered the modal 
        var modal       = $(this);
        //var title = button.data('title'); alert(title);
        var title = document.getElementById('txtposttitle').value;
        var imageIdElement = document.getElementById('imageIdUploaded');
        var fileInput = document.getElementById('imageFile');
        imageIdElement.textContent = '000';
        fileInput.value = '';
        modal.find('.modal-title').text(title);
        $('#btnCreatePost').css('display', 'flex');
        $('#btncloseModal').css('display', 'flex');
        $('#loading-btnCreatePost').css('display', 'none');
        $('#txtResult').css('display', 'none');
    });



    function getPtt(){
      var title = document.getElementById('txtposttitle').value;
      if(title == ''){
          alert('Enter post title !!');
      } else {
          generatenewPosttitle(title);
      }
    }

    function gennewintro(page){
      var title = document.getElementById('txtposttitle').value;
      if(title == ''){
          alert('Enter post title..');
      } else {
          var kwintro = document.getElementById("introKeyword").value;
          var keywordcategory = $('#keywordcategory').val().toString();
          generatenewintro(title,kwintro,keywordcategory,page);
      }
    }

    function setDataCheckEdt(){
       var arrData=[];
       var data1 = CKEDITOR.instances['txtintropost'].getData();
       var content = '<p>' + data1 +'</p>';
       // loop over each table row (tr)
       $("#listAdd tr").each(function(){
            var currentRow=$(this);
            var id=currentRow.find("td:eq(0)").text();
            //console.log(id);
            if(id == "") {
            } else {
                var title = $('#title' + id).val();
                var image=currentRow.find("td:eq(3)").find("img").attr('src');
                var price=currentRow.find("td:eq(4)").text();
                var description= $('#content' + id).val();
                var link=currentRow.find("td:eq(7)").find("a").attr('href');

                var obj={};

                /*obj.title=col1_value;
                obj.image=col2_value;
                obj.price=col3_value;
                obj.description=col4_value;
                obj.link=col5_value;

                arrData.push(obj);*/

                content = content + '<h2>'+ title + '</h2><p>' + description + '</p><img class="alignnone" src="' + image + '" alt="'+ title +'" width="700" height="700" /> <p>Buy it now from $'+ price +' here : <a href="'+ link +'">'+ title +'</a></p>';
            }
            
       });

       while (content.includes("<p></p>") || content.includes("<p><p>") || content.includes("</p></p>") ) {
            content = content.replace("<p></p>", "");
            content = content.replace("<p><p>", "<p>");
            content = content.replace("</p></p>", "</p>");
            //console.log(contentDescription);
        }
        
       CKEDITOR.instances['desc'].setData(content);
       
    }
    function btncreatePost(){
        var titleValue = $("#txtposttitle").val();
        var urlimg = $("#imgfeaturedinmodal").val();
        var data = CKEDITOR.instances.desc.getData();
        var imageId = $("#imageIdUploaded").text();
        var selectPostCategory = $('#postcategory').val();
        if(selectPostCategory == '' || selectPostCategory == null) {
          alert('Select post category !');
        } else {
          createPostJS(titleValue,data,urlimg,imageId,selectPostCategory);
          //alert(selectPostCategory);
        }
       
    }

  </script>

  <script>
  document.getElementById('uploadForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var fileInput = document.getElementById('imageFile');
    var file = fileInput.files[0];
    if(file == '' || !file) {
      alert('Choose image');
      return;
    } else {
        var formData = new FormData();
        formData.append('file', file);
        
        var request = new XMLHttpRequest();
        request.open('POST', 'https://themegatee.com/wp-json/wp/v2/media');
        request.setRequestHeader('Authorization', 'Basic ' + btoa('khajob96:vjkdh65734$%#$'));
        request.onreadystatechange = function() {
          if (request.readyState === 4) {
            var uploadButton = document.getElementById('uploadButton');
            var loadingIcon = document.getElementById('loadingIcon');
            var imageIdElement = document.getElementById('imageIdUploaded');
            
            if (request.status === 201) {
              var response = JSON.parse(request.responseText);
              var imageId = response.id;
              imageIdElement.textContent = imageId;
              fileInput.value = '';
              //console.log('Image uploaded successfully! ID: ' + imageId);
            } else {
              //console.log('Image upload failed. Status: ' + request.status);
              imageIdElement.textContent = 'Image upload failed. Status: ' + request.status;
            }
            
            loadingIcon.classList.add('d-none');
            uploadButton.classList.remove('d-none');
          }
        };
        
        var uploadButton = document.getElementById('uploadButton');
        var loadingIcon = document.getElementById('loadingIcon');
        
        loadingIcon.classList.remove('d-none');
        uploadButton.classList.add('d-none');
        
        request.send(formData);
    }
  });
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
</body>
</html>