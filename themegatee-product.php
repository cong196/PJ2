<?php

use Automattic\WooCommerce\Client;
require __DIR__ . '/vendor/autoload.php';
//include "dbConnect.php";

function get10($pg, $perpage){
  $woocommerce = new Client(
      'https://themegatee.com', 
      'ck_87beed3473355a6ace23dcbb2ae8a5493baef275', 
      'cs_c79fa1db19ed6b4940a5109d247c486bed4585cb',
      [
          'version' => 'wc/v3',
      ]
  );

  $prds = $woocommerce->get('products/?status=publish&page=1&per_page=10');
    return $prds;
};

$g10 = get10($page,$perpage); 
$testvvv = "10";
//var myJson = <?php echo json_encode($g10)
?>

<!-- <script src="http://code.jquery.com/jquery-latest.js"></script> -->

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
 -->

<script src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript" src="/PJ2/generatenewtitle.js"></script>
<script type="text/javascript" src="/PJ2/generatenewcontent.js"></script>

<script>
    function getPrducts($page,$perage,$searchTitle) {
        //var query_parameter = document.getElementById("name").value;
        //var dataString = 'parameter=' + query_parameter;
        $.ajax({
            type: "POST",
            url: "getProduct.php",
            data: {page: $page, perage: $perage, searchTitle: $searchTitle},
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
  function removeRow(buttonElement) {
      
      var row = buttonElement.closest('tr');
      row.parentNode.removeChild(row);
  }
  function addtoList($name,$id,$img,$price,$link){
     //console.log(JSON.parse("<?php echo $g10[0]->name ?>"));
      /*$('#listAdd tr:last').after('<tr><td>'+$id+'</td><td><button onclick="generatenewtitle(\''+$name+'\' , '+$id+','+'"themegatee")" type="button" style="display:flex" id="gennewtitle-'+$id+'"class="btn btn-secondary btn-sm">New title</button> <div style="display:none" class="spinner-border spinner-border-sm" id="gennewtitle-'+$id+'loading" role="status"><span class="sr-only"></span> </div> </td><td><textarea class="form-control" id="title'+ $id +'" rows="1">'+$name+'</textarea></td><td><div class="zoomsss"><img src="'+$img+'" class="img-fluid img-thumbnail" width="60px"></div></td>><td>'+ $price +'</td><td><textarea class="form-control" id="content'+ $id +'" rows="1">'+$name+'</textarea></td><td><button onclick="genContent(\''+$name+'\' , '+$id+')" type="button" style="display:flex" id="gennewcontent'+$id+'" class="btn btn-secondary btn-sm">New content</button> <div style="display:none" class="spinner-border spinner-border-sm" id="gennewcontent-'+$id+'loading" role="status"><span class="sr-only"></span> </div></td><td><a href="https://themegatee.com/product/'+$link+'" target="_blank"><i class="bi bi-eye"></i></a></br><button type="button" class="btn btn-secondary btn-sm remove-button">Remove</button></td></tr>');*/

        $('#listAdd tr:last').after('<tr><td>' + $id + '</td><td><button onclick="generatenewtitle(\'' + $name + '\' , ' + $id + ',\'themegatee\')" type="button" style="display:flex" id="gennewtitle-' + $id + '" class="btn btn-secondary btn-sm">New title</button> <div style="display:none" class="spinner-border spinner-border-sm" id="gennewtitle-' + $id + 'loading" role="status"><span class="sr-only"></span></div></td><td><textarea class="form-control" id="title' + $id + '" rows="1">' + $name + '</textarea></td><td><div class="zoomsss"><img src="' + $img + '" class="img-fluid img-thumbnail" width="60px"></div></td><td>' + $price + '</td><td><textarea class="form-control" id="content' + $id + '" rows="1">' + $name + '</textarea></td><td><button onclick="genContent(\'' + $name + '\' , ' + $id + ')" type="button" style="display:flex" id="gennewcontent' + $id + '" class="btn btn-secondary btn-sm">New content</button> <div style="display:none" class="spinner-border spinner-border-sm" id="gennewcontent-' + $id + 'loading" role="status"><span class="sr-only"></span></div></td><td><a href="https://themegatee.com/product/' + $link + '" target="_blank"><i class="bi bi-eye"></i></a><br><button type="button" class="btn btn-secondary btn-sm remove-button" onclick="removeRow(this)">Remove</button></td></tr>');
    }


</script>

<style>
.zoomsss {
  transition: transform .1s; /* Animation */
  margin: 0 auto;
}

.zoomsss:hover {
  transform: scale(6.5);
}
</style>
<?php 
  function clean($string) {
    $new_string = str_replace(
        [",", "<", "'", "!", "'"], // 1. special chars to remove
        "",                   // 2. replacement for the chars
        $string               // 3. the original string
    );
    return $new_string;
  }
?>
<div class="w-100 p-3">
  <div class="row">


    <div class="col-12" id="dataProducts">
    <table class="table table-image">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Title</th>
          <th scope="col">Image</th>
          <th scope="col">Price</th>
          <th scope="col">Add</th>
          <th scope="col">View</th>
        </tr>
      </thead>
      <tbody>

<?php 
  $prz=0;
  while($prz<$perpage){
    $imgprt = $g10[$prz]->images[0]->src;
?>

        <tr style="vertical-align:initial">
          <th scope="row"><?php echo $g10[$prz]->id ?></th>
          <th scope="row"><?php echo $g10[$prz]->name ?></th>
          <td>
            <div class="zoomsss"><img src="<?php echo $imgprt ?>" class="img-fluid img-thumbnail" width="100px"></div>
          </td>
          <td><?php echo $g10[$prz]->price ?></td>
        
          <td>
              <button id="<?php echo $g10[$prz]->id .'-add' ?>" type="button" class="btn btn-primary" style="display:flex" onclick="addtoList(<?php echo "'".clean($g10[$prz]->name). "',".  $g10[$prz]->id . ",'". $imgprt ."','". $g10[$prz]->price . "','". substr(substr($g10[$prz]->permalink,31),0,-1) ."'"?>)"> Add</button>
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


<script type="text/javascript">
    $(document).ready(function() {
      $('.remove-button').on('click', function() {
        $(this).closest('tr').remove();
      });
  });
</script>



<!-- <script type="text/javascript">
  
  $("#checkSellectAll").click(function () {
      $(".check").prop('checked', $(this).prop('checked'));
  });
  
  function btbAddImage(){
    //console.log('clicked');
    const checkboxs = document.getElementsByClassName("check");
    
    var arrid = "";
    var bla = "";
    for(let i = 0; i < checkboxs.length ; i++) {
      //checkboxs[i].checked = !checkboxs[i].checked;
      if (checkboxs[i].checked) {

        arrid = arrid + $(checkboxs[i]).attr('id') + ',';
      }
    }
    if(arrid==""){
      alert("Select product !!");
    } else {
      arrid = arrid.slice(0, -1);
      bla = document.getElementById("searchTxt").value;
      
      //console.log('truoc khi vo la ' + arrid);
      AddimageSL(arrid,3,bla);
      //alert(bla);
    }
    
  }

</script> -->

