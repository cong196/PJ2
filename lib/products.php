<?php

use Automattic\WooCommerce\Client;
require __DIR__ . '/vendor/autoload.php';

function get10(){
$woocommerce = new Client(
    'https://plangraphics.com', 
    'ck_4a33cc71e50ef8f10d8d16533e97d645ed18c40d', 
    'cs_bc465ea2ca81be7a19234532391f810ec2331371',
    [
        'version' => 'wc/v3',
    ]
);
$prds = $woocommerce->get('products/?page=2');
//echo "<script>console.log('Debug Objects: " . $prds . "' );</script>";
//echo "<pre>";
//print_r($prds);
//echo "</pre>";
  return $prds;
}

<div class="container">
  <div class="row">
    <div class="col-12">
    <table class="table table-image">
      <thead>
        <tr>
          <th scope="col">Title</th>
          <th scope="col">Image</th>
          <th scope="col">Price</th>
         <th scope="col">Sync</th>
        </tr>
      </thead>
      <tbody>

<?php 
  $prz=0;
  while($prz<10){
    $imgprt = $g10[$prz]->images[0]->src;
?>

        <tr>
          <th scope="row"><?php echo $g10[$prz]->name ?></th>
          <td>
            <img src="<?php echo substr($imgprt,0,-4) ?>-150x150.<?php echo substr($imgprt,-3) ?>" class="img-fluid img-thumbnail" width="100px" alt="Sheep">
          </td>
          <td><?php echo $g10[$prz]->price ?></td>
        <th scope="row"><button type="button" class="btn btn-primary" onclick="show()">Sync Now</button>
</th>
        
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

?>