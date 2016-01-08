<?php

//echo $_GET['username'];
require_once './function/DbConnect.php';
$con=DbConnect::connection(); //
mysql_select_db("app_mtcds",$con);

$username=$_GET['username'];
$result=DbConnect::selectByOpenId("*",$username);
$datetime=date("Y-m-d H:i:s");
$words=$_POST['words'];
$sql="INSERT INTO comments VALUES(\"$result[name]\",\"$result[apartment]\",\"$words\",\"0\",\"$datetime\")";
$insert=mysql_query($sql);
if($insert){
    echo "评价发表成功！";
}
else{
echo mysql_error();
}
$updatecomment="UPDATE user SET comment = 0 WHERE username= \"$username\" ";
//echo $updatecomment;//
mysql_query($updatecomment);

/*
$querycomment="SELECT comment FROM user WHERE username=\"$username\"";//
echo $querycomment;//
$result=mysql_fetch_array(mysql_query($querycomment));//
echo $result['comment'];//
echo mysql_error();//
*/
?>