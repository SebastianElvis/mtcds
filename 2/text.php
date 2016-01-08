<?php
session_start();
require_once './function/DbConnect.php';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    </head>
    <body>
<?php
require_once './Cart.php';

$con=DbConnect::Connection();
$cart=  new Cart(1);

echo "<table border=1>";
$data = $_SESSION['cart'];
echo "<tr><td>菜品名</td><td>单价</td><td>数量</td></tr>";
foreach($data as $item){
    
    $queryFood=DbConnect::queryFoodById($con,$item['id']);
    $resultFood=mysql_fetch_array($queryFood);
    
    echo "<tr><td>".$resultFood['name']."</td><td>".$item['price']."</td><td>".$item['num']."</td></tr>";
}
echo "</table>";
echo $cart->getPrice();
echo "<form action='submit.php' method='post'>";
echo "</br>请选择配送方式，选择‘配送’即为配送到宿舍，如果您想自己顺路带回宿舍，请选择‘自取’，在学三楼下曙光打印店附近餐车处领餐</br>";
echo "<select name='type'><option value=\"配送\">配送</option><option value=\"自取\">自取</option><option value=\"订餐送TA\">订餐送TA</option></select></br>";
echo "<input type='submit'>";
?>
        
    </body>
</html>       