<?php
use Automattic\WooCommerce\Client;
require __DIR__ . '/vendor/autoload.php';

$page = $_POST['page'];
$perpage = $_POST['perage'];
$searchTitle = $_POST['searchTitle'];

function get10($pg, $perpage,$searchTitle){
  $woocommerce = new Client(
      'https://themegatee.com', 
      'ck_87beed3473355a6ace23dcbb2ae8a5493baef275', 
      'cs_c79fa1db19ed6b4940a5109d247c486bed4585cb',
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

$g10 = get10($page,$perpage,$searchTitle); 

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
  while($prz<count($g10)){
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