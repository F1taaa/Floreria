<?php
include '../classes/class.product.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'newtype':
        create_new_type();
        break;
    case 'newproduct':
        create_new();
        break;
    case 'updateproduct':
        update_product();
        break;
    case 'deleteproduct':
        delete_product();
        break;
}

function create_new_type()
{
    $product = new Product();
    $tname = ucwords($_POST['tname']);
    $tid = $product->new_product_type($tname);
    if (is_numeric($tid)) {
        header('location: ../index.php?page=products&action=types&id=' . $tid);
    }
}
function create_new()
{
    $product = new Product();
    $pname = ucwords($_POST['pname']);
    $price = $_POST['price']; 
    $type = $_POST['ptype'];
    $pid = $product->new_product($pname, $price, $type);
    if (is_numeric($pid)) {
        header('Location: ../index.php?page=products&action=' . $pid); 
        exit(); 
    }
}

function update_product()
{
    $product = new Product();
    $pname = ucwords($_POST['pname']);
    $type = $_POST['ptype'];
    $pid = $_POST['prodid'];
    $result = $product->update_product($pname, $type, $pid);
    header('location: ../index.php?page=products&action' . $pid);
}
function delete_product()
{
    if (isset($_POST['prodid']) && is_numeric($_POST['prodid'])) {
        $product = new Product();
        $pid = $_POST['prodid'];
        $result = $product->delete_product($pid);
        if ($result) {
            header('location: ../index.php?page=products&action');
        } else {
            echo "Error deleting product.";
        }
    } else {
        echo "Invalid product ID.";
    }
}

