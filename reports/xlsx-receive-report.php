<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=".date("Y-m-d")."-receive-report.xls");

include_once '../classes/class.receive.php';
include '../config/config.php';

$receive = new receive();
echo 'Nbr' . "\t" . 'Receive Date' . "\t" . 'Supplier/Product' . "\t" . 'Product Status' ."\t" . 'Receive Status' . "\n";

$count = 1;
if($receive->list_receive() != false){
    foreach($receive->list_receive() as $value){
        extract($value);
        {        
            echo $count . "\t" .$rec_date_added.', '. $rec_supplier . ' - ' . $rec_description . "\t" .  $rec_stats . "\t" .$rec_saved . "\n";
            
                $count++;
        }
    }
}