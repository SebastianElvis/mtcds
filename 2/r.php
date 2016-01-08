<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
        <style>
            body{
                font-size:40px;
            }
        </style>
    </head>
    <body>
<?php
require_once './function/DbConnect.php';
require_once './function/Time.php';
$timelevel = Time::getTimeLevel();
if(!isset($_GET['type']))
{
   
    echo "</br></br><ul>
            <li><a href=\"r.php?type=1\">&nbsp;&nbsp;&nbsp;&nbsp;运送员界面</a></li>
            </br></br>
            <li><a href=\"r.php?type=2\">&nbsp;&nbsp;&nbsp;&nbsp;配送员界面</a></li>
        </ul>
    </body>
</html>";
        
}
if($_GET['type']==1)
{
$result;
    $foodlist=array();
    $food=array();
    $con = DbConnect::connection();
    mysql_select_db("app_mtcds", $con);

    $result = mysql_query("SELECT telephone,apartment,number,user.name as name1,time1,formorder.id as id1,restaurant.name as restname ,foodid, food.name, price, cost, food.restid, amount
FROM food, formorder,restaurant,user
WHERE food.id = foodid

AND restaurant.restid = food.restid
AND user.username=formorder.username
ORDER BY food.restid,user.name" );
    
    
        while($row=mysql_fetch_array($result)){
        $id=$row['id1'];
        if(!isset($foodlist[$id])){
            $food['name']=$row['name'];
            $food['num']=$row['amount'];
            $food['rest']=$row['restname'];
            $food['cost']=$row['cost'];
            $food['time']=$row['time1'];
            $food['user']=$row['name1'];
            $food['apartment']=$row['apartment'];
            $food['number']=$row['number'];
            $food['telephone']=$row['telephone'];
            $food['id1']=$id;
            $foodlist[$id]=$food;}
        else
        {
            $foodlist[$id]['num']+=$row['amount'];
        }
    }
    $data=$foodlist;
    $sum = 0;
    echo "<table>";
    foreach($data as $food){
        echo "<tr><td>".$food['id1']."</td><td>".$food['name']."</td>";
        if($food['num']>1){
            echo "<td style=\"color:red\">".$food['num']."</td>";
        }
        else{
            echo "<td>".$food['num']."</td>";
        }
        echo "<td>".$food['cost']."</td><td>".$food['rest']."</td><td>".$food['time']."</td><td>".$food['user']."</td><td>".$food['apartment']."</td><td>".$food['number']."</td><td>".$food['telephone']."</td></tr>";
        $sum += $food['cost']*$food['num'];
    }
    echo "</table>";
    echo "</br>";
    echo $sum;
    mysql_close($con);
}
if($_GET['type']==2)
   {
   		$con = DbConnect::connection();
        mysql_select_db("app_mtcds", $con);
    $result;
   
    	$result = mysql_query("SELECT formorder.type as type1 ,formorder.id as id1,time1,food.name as a, amount, number, apartment, telephone, price,user.name as b FROM food, user, formorder WHERE formorder.username = user.username AND formorder.foodid = food.id and (
(
ordertime = ( 
SELECT DATE_SUB( CURDATE( ) , INTERVAL 1 
DAY ) ) 
AND (timelevel =  '5' or timelevel='7') 
)
or(
ordertime=curdate() and (timelevel='1' or timelevel='2'))
)order by apartment,formorder.username");
    echo "<table><tr><td>食品</td><td>数量</td><td>价格</td><td>楼号</td><td>房间号</td><td>姓名</td><td>手机号</td><td>配送</td></tr>";
    $sum=0;
    $row=mysql_fetch_array($result);
    echo "<tr><td>".$row['id1']."</td><td>".$row['a']."</td>";
                if($row['amount']>1)
            {
                echo "<td style=\"color:red\">".$row['amount']."</td>";
            }
            else
            {
                echo "<td>".$row['amount']."</td>";
            }
            echo "<td>".$row['price']."</td><td>".$row['apartment']."</td><td>".$row['number']."</td><td>".$row['b']."</td><td>".$row['telephone']."</td><td>".$row['time1']."</td><td>".$row['type1']."</td></tr>";
    
    $sum=$sum+$row['price']*$row['amount'];
    $user=$row['b'];

        while($row=mysql_fetch_array($result)){
            if(strcmp($row['b'],$user)!=0){
                echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>".$sum."</td></tr>";
                $sum=0;
                $user=$row['b'];
            }
            echo "<tr><td>".$row['id1']."</td><td>".$row['a']."</td>";
                if($row['amount']>1)
            {
                echo "<td style=\"color:red\">".$row['amount']."</td>";
            }
            else
            {
                echo "<td>".$row['amount']."</td>";
            }
    $sum=$sum+$row['price']*$row['amount'];

            echo "<td>".$row['price']."</td><td>".$row['apartment']."</td><td>".$row['number']."</td><td>".$row['b']."</td><td>".$row['telephone']."</td><td>".$row['time1']."</td><td>".$row['type1']."</td></tr>";
        } 
    echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>".$sum."</td></tr>";
    echo"</table>";
}
        ?>
    </body>
</html>        