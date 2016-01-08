<?php session_start();
require_once './function/DbConnect.php';
require_once './function/Time.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTDDbConnect XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    </head>
    <body>
<?php
$username=$_SESSION['openid'];
$timelevel=Time::getTimeLevel();
    $con = DbConnect::connection();
    mysql_select_db("app_mtcds", $con);
$result;
if(isset($_GET['id']))
{
    $a=mysql_query("delete from formorder where id=".$_GET['id']."");
}
 $result = mysql_query("SELECT formorder.id as number, name, price, amount
FROM food, formorder
WHERE food.id = foodid
and foodid=1115
AND formorder.username='".$username."'
ORDER BY restid" );
if($timelevel==1 or $timelevel==2  )
{

    $result = mysql_query("SELECT formorder.id as number, name, price, amount
FROM food, formorder
WHERE food.id = foodid
AND (
(
ordertime = ( 
SELECT DATE_SUB( CURDATE( ) , INTERVAL 1 
DAY ) ) 
AND (timelevel = '5' or timelevel='7')
)
or(
ordertime=curdate() and (timelevel='2' or timelevel='1')
))
AND formorder.username='".$username."'
ORDER BY restid" );}
if($timelevel==3 or $timelevel==4 or $timelevel==6)
{

    $result = mysql_query("SELECT formorder.id as number, name, price, amount
FROM food, formorder
WHERE food.id = foodid
AND (
ordertime=curdate() and (timelevel='4' or timelevel = '3')
)
AND formorder.username='".$username."'
ORDER BY restid" );}
if($timelevel==5 or $timelevel==7)
{

    $result = mysql_query("SELECT formorder.id as number, name, price, amount
FROM food, formorder
WHERE food.id = foodid
AND (
ordertime=curdate() and (timelevel = '5' or timelevel='7')
)
AND formorder.username='".$username."'
ORDER BY restid");}
echo "<table>";
echo "<tr><td>名称</td><td>数量</td><td>单价</td></tr>";
       while($row=mysql_fetch_array($result)){
           if($timelevel==1 or $timelevel==3 or $timelevel==5 or $timelevel==6 or $timelevel==7)
           {
               echo "<tr><td>".$row['name']."</td><td>".$row['amount']."</td><td>".$row['price']."</td><td><a href=\"myorder.php?id=".$row['number']."\">退单</a></td></tr>";
           }
           else
           {
               echo "<tr><td>".$row['name']."</td><td>".$row['amount']."</td><td>".$row['price']."</td></tr>";
           }
       }
echo "</table>";
?>
    </body>
</html>
