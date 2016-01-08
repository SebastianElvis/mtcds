<?php 
session_start();
require_once("./function/DbConnect.php");
require_once("./function/Time.php");?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    </head>
    <body>

<?php
$con = DbConnect::connection();
$timelevel=Time1::getTimeLevel();
$username=$_SESSION['openid'];
mysql_select_db("app_mtcds",$con);



if(!isset($_GET['id']))
{
$data = $_SESSION['cart'];
    
    
    

foreach ($data as $item) {
    
    $queryRestid=mysql_query("SELECT * FROM food WHERE id=".$item['id']);
    $resultRestid=mysql_fetch_array($queryRestid);
    $resultRestid=$resultRestid['restid'];
    $queryRest=mysql_query("SELECT * FROM restaurant WHERE restid=".$resultRestid);
    $resultRest=mysql_fetch_array($queryRest);
    $resultRest=$resultRest['name'];
    
    
    mysql_query("insert into formorder (foodid,restaurant,amount,username,ordertime,timelevel,time1,type) value('".$item['id']."','".$resultRest."','".$item['num']."','".$_SESSION['openid']."',(now()),'".$timelevel."',(now()),'".$_POST['type']."')");
        }
}
$result;
if(isset($_GET['id']))
{
    $a=mysql_query("delete from formorder where id=".$_GET['id']."");
}
if($timelevel==1 or $timelevel==2 )
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
ORDER BY restid" );
echo "订餐成功，您的订单将在今天中午12:00左右送达";}
if($timelevel==3 or $timelevel==4 )
{
    $result = mysql_query("SELECT formorder.id as number, name, price, amount
FROM food, formorder
WHERE food.id = foodid
AND (
ordertime=curdate() and (timelevel = '3' or timelevel='4')
)
AND formorder.username='".$username."'
ORDER BY restid" );
echo "订餐成功，您的订单将在今天下午5:30左右送达";}
if($timelevel==5 )
{
    $result = mysql_query("SELECT formorder.id as number, name, price, amount
FROM food, formorder
WHERE food.id = foodid
AND (
ordertime=curdate() and (timelevel = '5' or timelevel='7')
)
AND formorder.username='".$username."'
ORDER BY restid" );
echo "订餐成功，您的订单将在明天中午12:00左右送达";}
echo "<table>";
echo "<tr><td>名称</td><td>数量</td><td>单价</td></tr>";
       while($row=mysql_fetch_array($result)){
           if($timelevel==1 or $timelevel=3 or $timelevel==5)
           {
               echo "<tr><td>".$row['name']."</td><td>".$row['amount']."</td><td>".$row['price']."</td><td><a href=\"submit.php?id=".$row['number']."\">退单</a></td></tr>";
           }
           else
           {
               echo "<tr><td>".$row['name']."</td><td>".$row['amount']."</td><td>".$row['price']."</td></tr>";
           }
       }
echo "</table>";
echo "<a href=\"alldishes.php?username=".$_SESSION['openid'].">返回主菜单</a>";
mysql_close($con);
            ?>

    </body>
</html>
