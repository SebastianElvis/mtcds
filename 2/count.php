<?php
session_start();
require_once './Cart.php';
$cart=  new Cart(1);
if($_GET['type']==1){
$cart->addItem($_GET['id'],1,$_GET['price']);
}
else{    
$cart->decNum($_GET['id'],1);
}
?>