<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=" . date("Y-m-d") . "-inventory-report.xls");

include_once '../classes/class.product.php';
include_once '../classes/class.inventory.php';
include '../config/config.php';

$product = new Product();
$inventory = new Inventory();
echo  'Product' . "\t" . 'Received' . "\t" . 'Released' . 'In Stock' . "\t" .'Retail Price' . "\t".'Value Sold' . "\t".'Stock Value' ."\n";

$count = 1;
if ($product->list_product() != false) {
    foreach ($product->list_product() as $value) {
        extract($value);
                
        echo $prod_name . "\t" .$inventory->get_product_receive_inv($prod_id)  . "\t" . $inventory->get_product_release_inv($prod_id) ."\t" . $inventory->get_product_receive_inv($prod_id) - $inventory->get_product_release_inv($prod_id) ."\t" . $product->get_prod_price($prod_id) ."\t" .number_format($product->get_prod_price($prod_id) * $inventory->get_product_release_inv($prod_id)) ."\t" . number_format($product->get_prod_price($prod_id) * ($inventory->get_product_receive_inv($prod_id) - $inventory->get_product_release_inv($prod_id)))."\n";
        
        $count++;
    }
}
