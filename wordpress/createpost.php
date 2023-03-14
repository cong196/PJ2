<?php
require_once("wp-load.php");

$noidung = '
    <h2>Winnipeg Jets Sneaker - Custom AF 1 Shoes for Men and Women.</h2>
Highbury insole make the the shoes comfortable and soft ,and scaly sole increases slip resistance.
<h3><strong> Winnipeg Jets Sneaker - Custom AF 1 Shoes images </strong></h3>
[caption id="" align="alignnone" width="800"]<img src="https://www.air-yeezyshoes.com/wp-content/uploads/2022/08/winnipeg-jets-sneaker_rhtgtw.jpg" alt="Winnipeg Jets Sneaker - Custom AF 1 Shoes" width="800" height="800" /> Winnipeg Jets Sneaker - Custom AF 1 Shoes[/caption]

<img src="https://www.air-yeezyshoes.com/wp-content/uploads/2022/08/winnipeg-jets-sneaker-20_nzszxz.jpg" alt="Winnipeg Jets Sneaker - Custom AF 1 Shoes" width="800" height="800" />
<h3>Product description</h3>
<ul>
    <li>The upper is made of PU and the sole is made of rubber.</li>
    <li>Feature: Anti-Slippery, perforated upper for breathability.</li>
    <li>Season: Autumn, Spring, Summer, Winter.</li>
    <li>Occasion: Outdoor, Daily.</li>
    <li>Care Instruction: Spot clean only.</li>
    <li>This product is made on demand. No minimums.</li>
</ul>
<h3>Size chart</h3>
<img class="alignnone size-medium" src="https://www.air-yeezyshoes.com/wp-content/uploads/2021/10/naf-nas-size.png" width="1158" height="354" />

See more of our custom AF1 shoes at: <a href="https://www.air-yeezyshoes.com/product-category/air-force-1/"><strong>AF 1 Shoes - Shoes store</strong></a>
';
$api_response = wp_remote_post( 'https://www.air-yeezyshoes.com/wp-json/wp/v2/posts', array(
    'headers' => array(
        'Authorization' => 'Basic ' . base64_encode( 'hvantoan166@gmail.com:jb2CzjxnQE' )
    ),
    'body' => array(
        'title'   => 'Winnipeg Jets Sneaker – Custom AF 1 Shoes for Men and Women.',
        'status'  => 'publish',  
        'content' => $noidung,
        'categories' => 17
    )
) );
  
$body = json_decode( $api_response['body'] );
  
if( wp_remote_retrieve_response_message( $api_response ) === 'Created' ) {
    echo 'The post ' . $body->title->rendered . ' has been created successfully';
} else {
    echo 'Loi';
}

?>