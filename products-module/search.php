<?php
include_once '../classes/class.product.php';
include_once '../classes/class.inventory.php';
include '../config/config.php';
$product = new Product();
$inventory = new Inventory();
$q = $_GET["q"];
$count = 1;
$hint=' <h3>Search Result(s)</h3><table id="data-list">
<tr>
  <th>#</th>
  <th>Product Details</th>
  <th>QOH</th>
</tr>';
$data = $product->list_product_search($q);
if($data != false){
    //$hint = '<ul>';
    foreach($data as $value){
        extract($value);

        //$hint .= '<li>'.$prod_name. '</li>';
        $hint .= '
       <tr>
        <td>'.$count.'</td>
        <td><a href="index.php?page=products&action=profile&id='.$prod_id.'">'.$prod_name.'</a></td>
        <td>'.($inventory->get_product_receive_inv($prod_id) - $inventory->get_product_release_inv($prod_id)).'</td>
        </tr>';
        $count++;
    }
}
$hint .= '</table>';

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "No result(s)" : $hint;
?>