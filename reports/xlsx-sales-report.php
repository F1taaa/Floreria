<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=" . date("Y-m-d") . "-sales-report.xls");

include_once '../classes/class.release.php';
include '../config/config.php';

$release = new release();
echo 'Nbr' . "\t" . 'Prod Name' . "\t" . 'Description' . "\t" . 'QOH' ."\t". 'Status' . "\t" . "\n";

$count = 1;
if ($release->list_release() != false) {
    foreach ($release->list_release() as $value) {
        extract($value);
                
        echo $count . "\t" . $rel_date_added . ', ' .  $rel_customer . "\t" .  $rel_description ."\t".  $rel_amount  ."\t".$rel_saved."\n";
        
        $count++;
    }
}
