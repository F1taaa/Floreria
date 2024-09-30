<?php
include_once '../classes/class.product.php';
include_once '../classes/class.inventory.php';
include '../config/config.php';
require('../fpdf185/fpdf.php');

$product = new Product();
$inventory = new Inventory();

class PDF extends FPDF
{
//Page header
function Header(){
	 
	//Arial 12
	$this->SetFont('Arial','',12);
	//Background color
	$this->SetFillColor(200,220,255);
	//Title
	$this->Cell(0,6,"Inventory Report",0,1,'L',1);
	$this->SetFont('Arial','BIU',10);
	$this->Cell(0,6,"Date Generated ".date("Y-m-d h:i:s A")." ",0,1,'L',1);
	$this->SetFont('Arial','',12);
    
   
    //Line break
    $this->Ln(4);
}
function BasicTable($header){
    //Header
    foreach($header as $col)
        $this->Cell(47,7,$col,0,0,'C');
	$this->Ln();
}
//Page footer
function Footer(){
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//Instanciation of inherited class
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
// Default Header
//$header=array('Nbr','Name','Access Level','E-Mail');
//$pdf->BasicTable($header);
// Custom Header
$pdf->Cell(26, 10, "Product", 1, 0, 'C');
$pdf->Cell(26, 10, "Received", 1, 0, 'C');
$pdf->Cell(26, 10, "Released", 1, 0, 'C');
$pdf->Cell(26, 10, "In Stock", 1, 0, 'C');
$pdf->Cell(26, 10, "Retail Price", 1, 0, 'C');
$pdf->Cell(26, 10, "Value Sold", 1, 0, 'C');
$pdf->Cell(26, 10, "Stock Value", 1, 0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 12);

$count = 1;
if($inventory->list_instock() != false){
    foreach($inventory->list_instock() as $value){
        extract($value);
    {
    
        $pdf->Cell(26, 12, $prod_name, 0, 0, 'L');
        $pdf->Cell(26, 12, $inventory->get_product_receive_inv($prod_id), 0, 0, 'L');
        $pdf->Cell(26, 12, $inventory->get_product_release_inv($prod_id), 0, 0, 'L');
        $pdf->Cell(26, 12, $inventory->get_product_receive_inv($prod_id) - $inventory->get_product_release_inv($prod_id), 0, 0, 'L');
        $pdf->Cell(26, 12, $product->get_prod_price($prod_id), 0, 0, 'L');
        $pdf->Cell(26, 12, number_format($product->get_prod_price($prod_id) * $inventory->get_product_release_inv($prod_id)), 0, 0, 'L');
        $pdf->Cell(26, 12, number_format($product->get_prod_price($prod_id) * ($inventory->get_product_receive_inv($prod_id) - $inventory->get_product_release_inv($prod_id))), 0, 0, 'L');
        $pdf->Ln(6);
        $count++;
        
        }
    }
}	

$pdf->SetFont('Arial','I',12);
$pdf->Cell(176,12,"--That's All!--",0,0,'C');
$pdf->Output();
?>