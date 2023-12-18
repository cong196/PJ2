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
      $prds = $woocommerce->get('products/?status=publish&page='.$pg.'&per_page='.$perpage);
      return $prds;
  } else {
      $prds = $woocommerce->get('products/?status=publish&page='.$pg.'&per_page='.$perpage . '&search='. $searchTitle);
      /*$prds = array_filter($prds, function($product) use ($searchTitle) {
          return strpos(strtolower($product->name), strtolower($searchTitle)) !== false;
      });*/

      /*$g1 = array_filter($prds, function($product) use ($searchTitle) {
        return strpos(strtolower($product->name), strtolower($searchTitle)) !== false;
      });*/
      return $prds;
  }
  
};

$g100 = get10($page,$perpage,$searchTitle,$site);
/*$g100 = array_filter($g10, function($product) use ($searchTitle) {
        return strpos(strtolower($product->name), strtolower($searchTitle)) !== false;
});*/

?>
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
  while($prz<count($g100)){
    if (isset($g100[$prz]) && is_object($g100[$prz]) && isset($g100[$prz]->images) && is_array($g100[$prz]->images) && isset($g100[$prz]->images[0]->src)) {
        $imgprt = $g100[$prz]->images[0]->src;
      } else {
        break;
      }
  ?>

        <tr style="vertical-align:initial">
          <th scope="row"><?php echo $g100[$prz]->id ?></th>
          <th scope="row"><?php echo $g100[$prz]->name ?></th>
          <td>
            <div class="zoomsss"><img src="<?php echo $imgprt ?>" class="img-fluid img-thumbnail" width="100px"></div>
          </td>
          <td><?php echo $g100[$prz]->price ?></td>
        
          <td>
              <button id="<?php echo $g100[$prz]->id .'-add' ?>" type="button" class="btn btn-primary" style="display:flex" onclick="addtoList(<?php echo "'".preg_replace("/[^a-zA-Z0-9 ]+/", "", $g100[$prz]->name) . "',".  $g100[$prz]->id . ",'". $imgprt ."','". $g100[$prz]->price . "','". $g100[$prz]->permalink ."'"?>)"> Add</button>
          </td>

          <td><a href="<?php echo $g100[$prz]->permalink?>" target="_blank"><i class="bi bi-eye"></i></a></td>



        </tr>
       <?php 
       $prz++;
}
?>
      </tbody>
    </table> 