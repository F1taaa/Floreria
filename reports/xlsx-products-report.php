<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=" . date("Y-m-d") . "-products-report.xls");

include_once '../classes/class.product.php';
include_once '../classes/class.inventory.php';
include '../config/config.php';

$product = new Product();
$inventory = new Inventory();
echo 'Nbr' . "\t" . 'Prod Name' . "\t" . 'Description' . "\t" . 'QOH' . "\n";

$count = 1;
if ($product->list_product() != false) {
    foreach ($product->list_product() as $value) {
        extract($value);
                
        echo $count . "\t" . $prod_name . ', ' . $product->get_prod_type_name($product->get_prod_type($prod_id)) . "\t" . $inventory->get_product_receive_inv($prod_id) - $inventory->get_product_release_inv($prod_id) . "\n";
        
        $count++;
    }
}
