<html>            
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
        <style>
            body{
                font-size:10px;
               
                background-image:url(images/beijng.jpg);                     
                background-size:cover; 
            }
            div{
                color:#fff;
            }
            .box{width:23%;height:7%; background:#FF69B4;-moz-border-radius:30px;-webkit-border-radius:30px;border-radius: 20px;text-align:center; line-height:43px;}
            .box1{width:70%;height:5%; background:#CAE1FF;-moz-border-radius:30px;-webkit-border-radius:30px;border-radius: 20px;text-align:center; line-height:43px;}
            .logo{
                filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true,sizingMethod=scale,src="http://mtcds-image.stor.sinaapp.com/1.png");width:70px;height:23px;}
        </style>
    </head>
</html>

<?php
define('GROUP',3);
require_once './function/DbConnect.php';
$username=$_GET['username'];
$con=DbConnect::connection(); //
mysql_select_db("app_mtcds",$con);

$querycomment=mysql_query("SELECT * FROM user WHERE username=\"$username\" ",$con); //获得当前用户信息
echo mysql_error();
$result=mysql_fetch_array($querycomment);
echo mysql_error();
//echo "<br/><br/>COMMENT TIME ",$commentTime,"<br/><br/>";//

$commentTime=$result['comment'];


$page=$_GET['page']?$_GET['page']:1; //分页显示评论结果
//echo $page;
//echo GROUP;
$offset=($page-1)*GROUP;
$sql="SELECT * FROM comments ORDER BY time DESC LIMIT $offset,".GROUP;
$query=mysql_query($sql,$con);

while($commentResult=mysql_fetch_array($query)){
    echo "<table border='1' width=350>";
    echo "<tr>";
    echo "<th align=left>昵称:$commentResult[id]"."	"."宿舍楼:$commentResult[apartment]<br/>时间:$commentResult[time]</th>";
    echo "</tr>";
    echo "<tr>";
    echo "<th align=left>评论:<br/>$commentResult[words]</th>";
    echo "</tr>";
    //echo "<tr><th align=left>点赞数:$commentResult[likes]</th></tr>";
    echo "</table>";
    echo "<br/>";
}
echo "<br/>";
$numbers=mysql_num_rows(mysql_query("SELECT * FROM comments"));
$totalpages=ceil($numbers/GROUP);
echo "总共 ",$totalpages,"页<br/>";
echo " 页数:";
for($i=1;$i<=$totalpages;$i++){
    if($i==$page){
    echo "$i ";
    }
    else{
        echo "<a href=\"comments.php?page=".$i."\">[$i] </a>";
    }
}



echo "<br/><br/>";

if($commentTime==0){
    echo "只有下单之后才能获得一次评价的机会哦╮(╯▽╰)╭<br/>欢迎对我们的服务提出宝贵意见，若有不周之处我们会及时改正(*•̀ㅂ•́)و";   
    mysql_free_result($querycomment);
	mysql_close($con);
    exit(0);
}

echo "<div class=\"box1\" style=\"  background:#CAE1FF; bottom:10%; right:50%; boder:1px solid;\">";  //position不为absolute
echo "昵称:",$result['name']," 宿舍楼:",$result['apartment']," 时间",date("Y-m-d H:i:s");//显示用户信息
echo "</div>";

echo "<form action=\"newcomments.php?username=$username\" method=\"POST\">";
echo "<textarea name=\"words\" style=\"height:200px;width:400px\"></textarea><br/>";
echo "<input type=submit value=\"提交评论\">";
echo "</form>";
 



//echo date("Y-m-d H:i:s");
mysql_free_result($querycomment);
mysql_close($con);


?>