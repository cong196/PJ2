<?php 
$page = 1;
settype($page, "int");

$nextpage = 1;

$perpage = 10;
settype($perpage, "int");

$searchTxt = "text"; 
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>Themegatee</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="/PJ2/bootstrap/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">


<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script type="text/javascript" src="/PJ2/gennewposttitle.js"></script>
<script type="text/javascript" src="/PJ2/createPost.js"></script>

<link rel="stylesheet" href="/PJ2/mystyle.css">
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
</div>


    <table class="table table-image" id="listAdd">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">NewTitle</th>
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

    function setDataCheckEdt(){
      

       var arrData=[];
       var content = '';
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

                content = content + '<h2>'+ title + '</h2><p>' + description + '</p><img class="alignnone" src="' + image + '" alt="'+ title +'" width="700" height="700" /> <p>Buy it now from '+ price +' here : <a href="'+ link +'">'+ title +'</a></p>';
            }
            
       });

       CKEDITOR.instances['desc'].setData(content);
      
    }
    function btncreatePost(){
        var titleValue = $("#txtposttitle").val();
        var data = CKEDITOR.instances.desc.getData();
        createPostJS(titleValue,data);
    }

  </script>

</body>
</html>