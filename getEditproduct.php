<?php
use Automattic\WooCommerce\Client;
require __DIR__ . '/vendor/autoload.php';

$page = $_POST['page'];
$perpage = $_POST['perage'];
$searchTitle = $_POST['searchTitle'];
$sites = $_POST['site'];
include "config.php";

$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

$site = json_decode(getKey($sites));

function get10($pg, $perpage,$searchTitle,$site){
  $woocommerce = new Client(
        $site->url, 
        $site->ck, 
        $site->cs,
      [
          'version' => 'wc/v3',
      ]
  );

  if($searchTitle == ''){
      $prds = $woocommerce->get('products/?page='.$pg.'&per_page='.$perpage);
      return $prds;
  } else {
      $prds = $woocommerce->get('products/?page='.$pg.'&per_page='.$perpage . '&search='. $searchTitle);
      return $prds;
  }
  
};

$g10 = get10($page,$perpage,$searchTitle,$site); 

?>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
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
          <td><button onclick="pregenDes(<?php echo $g10[$prz]->id . ",'". $g10[$prz]->name . "'" ; ?>)" type="button" style="display:flex" id="gendes-<?php echo $g10[$prz]->id;?>"class="btn btn-secondary btn-sm">New des</button></td>
          <td><?php echo $g10[$prz]->price ?></td>
        
          <td>
              <button id="<?php echo $g10[$prz]->id .'-add' ?>" type="button" class="btn btn-primary" style="display:flex" onclick="addtoList(<?php echo "'".$g10[$prz]->name. "',".  $g10[$prz]->id . ",'". $imgprt ."','". $g10[$prz]->price . "','". substr(substr($g10[$prz]->permalink,31),0,-1) ."'"?>)"> Add</button>
          </td>
          <td><a href="<?php echo $g10[$prz]->permalink?>" target="_blank"><i class="bi bi-eye"></i></a></td>

        
        </tr>
       <?php 
       $prz++;
}
?>
      </tbody>
    </table> 