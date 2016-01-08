<?php
session_start();
header("content-type:text/html;charset=utf-8");
require_once './function/DbConnect.php';
$openid= $_SESSION['openid'];
if(!isset($openid))
{
    exit();
}
if(($_POST['name']==null or $_POST['number'])==null or $_POST['telephone']==null ){
    echo "对不起，信息不全，请重新填写";
    sleep(3);
    echo "<script language=\"javascript\">";
	echo "history.go(-1)";
	echo "</script>";
}
else{
$con = DbConnect::connection();
DbConnect::insertByUsername($openid,$_POST['name'],$_POST['sex'],$_POST['apartment'],$_POST['number'],$_POST['telephone'],$con);
$url="order.php";

echo "<script language=\"javascript\">";
echo "location.href=\"$url\"";
echo "</script>";
    }
?>