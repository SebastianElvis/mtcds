<?php 
//开始点餐
session_start();
require_once './function/DbConnect.php';
require_once './function/Time.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTDDbConnect XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title></title>
    <script src="./function/jquery-1.6.2.min.js"></script>
<style type="text/css">
    .i_tips{height:30px;margin-left:20px;color:#f60;font-size:14px;line-height:30px}
	.i_box{margin:10px 20px;font-size:14px;float:left}
	.i_box *{vertical-align:middle}
	.i_box a{padding:2px 5px;background-color:#e9e9e9;border:1px solid #ccc;text-decoration:none;color:#585858;line-height:20px}
	.i_box a:hover{color:#000}
	.i_box input{width:30px;height:18px;margin:0 8px;padding:2px;border:1px solid #ccc;text-align:center;line-height:16px}
    
    
    body{
        background-image:url(images/beijng.jpg);    
        
    }
    
    
    #main{
        
					position: fixed;
				   	left: 0;
					z-index: 9000; /*--Keeps the panel on top of all other elements--*/
					background: #EEEEE0;
					
					border-bottom: none;
					width: 30%;
       				height:90%;;
        			font-size:80%;
    			}
    #footpanel {
       
					position: fixed;
					bottom: 0; left: 0;
					z-index: 9999; /*--Keeps the panel on top of all other elements--*/
					background:#8B0A50 ;
					border: 1px solid;
					border-bottom: none;
					width: 100%;
        			height: 10%;
        			font-weight:bold;
        			font:60px;
        			text-align:center;
        			overflow:hidden;
				}
    div.submit{
        width:80px;
        height:30px;
        line-height:30px;
        -moz-border-radius:30px;-webkit-border-radius:30px;border-radius: 4px;
            background:#cccc33;
        color:black;
        font-size:80%;    
        text-align:center;
        z-index: 9999;
        position:fixed;
        right:5%;
        bottom:3%;
    }
    div.submenu{
      
        background:#ffa54f;
        height:40px;
        line-height:40px;
        width:100%;
        text-align:center;
        font-size:80%;
        border:1px solid white;
    }
    div.plus{
        position:absolute;
        left:40%;
        height:50%;
        width:60%;
        bottom:0px;
    }
    img.itempic{
        position:absolute;
        top:10%;
        left:10%;
        width:80%;
        height:80%;
    }
    div.item{
        background : #ffffff;
        width:100%;
        border: 1px solid #D1D1D1;
        position:relative;
        height:15%;

    }

    
    div.pic{
        height:100%;
        width:40%;
        border:0px;
        position:absolute;
        left:0%;
    }
    div.infor{ 
        left:45%;
        height:50%;
        position:absolute;
        font-size:50%;
        top:0;
    }
    .infor p{
        margin:0px auto;
    }
    div.presssubmenu{
        background:#ff8c00;
        height:40px;
        line-height:40px;
        width:100%;
        text-align:center;
        font-size:100%; 
        border:3px inset;
    }
    #menu{
        font-size:20px;
        position: fixed;
        right: 0;
        width: 70%;
        top:0;
        height:90%;
        overflow:auto;
        background: #e4e3e3;
    }
    #bottomTable{
        			height:100%;
       				width:100%;
        			border:1px solid;
    				text-align:center;
    				vertical-align:middle;
        font-size:80%;
				}
    #leftMenu{
        font-weight:50px;
        
    }

</style>
    <script>
 

     var perDiv=null;
function chgColor(_this)
{
  if(perDiv) perDiv.style.backgroundColor='';
  _this.style.backgroundColor='red';
  perDiv=_this;
}        
        
        
function InitAjax()
{
 var ajax=false; 
 try { 
  ajax = new ActiveXObject("Msxml2.XMLHTTP"); 
 } catch (e) { 
  try { 
   ajax = new ActiveXObject("Microsoft.XMLHTTP"); 
  } catch (E) { 
   ajax = false; 
  } 
 }
 if (!ajax && typeof XMLHttpRequest!='undefined') { 
  ajax = new XMLHttpRequest(); 
 } 
 return ajax;
}
function getNews(newsID,type,price)
{
 //如果没有把参数newsID传进来
 if (typeof(newsID) == 'undefined')
 {
  return false;
 }
 //需要进行Ajax的URL地址
 var url = "/count.php?id="+ newsID+"&type="+type+"&price="+price;

 //获取新闻显示层的位置
 var show = document.getElementById("ok");

 //实例化Ajax对象
 var ajax = InitAjax();

 //使用Get方式进行请求
 ajax.open("GET", url, true);

 //获取执行状态
 ajax.onreadystatechange = function() { 
  //如果执行是状态正常，那么就把返回的内容赋值给上面指定的层
  if (ajax.readyState == 4 && ajax.status == 200) { 
   show.innerHTML = ajax.responseText; 
  } 
 }
 //发送空
 ajax.send(null); 
}   
        
        
        
      
    
    
    
    
    
    </script>

</head>
    
<body>
       
    <?php


$username=$_SESSION['openid'];
$con=DbConnect::connection();
$status=DbConnect::getStatus($con);
if(strcmp($_SESSION['openid'],'oZUx9jiZVMqe3iNB9NxNqzvHpRTc')==0){
    echo"<p>   <script language=\"javascript\">   alert(\"请通过关注微信平台liankexinda进行点餐，通过浏览器点餐目前无法识别。\");   </script>   </p>";
    exit();
}
if(!isset($_SESSION['openid']))
{
    echo"<p>   <script language=\"javascript\">   alert(\"请通过关注微信平台liankexinda进行点餐，通过浏览器点餐目前无法识别。\");   </script>   </p>";
    exit();
}
$time = Time::getTimeLevel();

if(($time==2 and !isset($_GET['a'])) && (!DbConnect::queryAdmin($username)))
{
    echo"<p>   <script language=\"javascript\">   alert(\"对不起~我们的订餐时间已经截止，勤劳的运送员已经在采购~12点左右，美食就能出现在宿舍门口啦。没有订餐的同学不要着急下午的订餐时间将在11点50后开放\");   </script>   </p>";
    exit();
}
if(($time==4 and !isset($_GET['a'])) && (!DbConnect::queryAdmin($username)))
{
    echo"<p>   <script language=\"javascript\">   alert(\"对不起~我们的订餐时间已经截止，勤劳的运送员已经在采购~5点半左右，美食就能出现在宿舍门口啦。没有订餐的同学不要着急下一次订餐时间将在17：30后开放\");   </script>   </p>";
    exit();
}


		$type = 0;
		if(!isset($_GET['type']))
        {
            $type =1;
        }
		else
        {
            $type = $_GET['type'];
        }

          if($type==1)
            {
              echo"<div id='main'>";
              $result=DbConnect::queryRest($status);
              while($row=mysql_fetch_array($result))
                    {
                  		if(isset($_GET['rest']) && $_GET['rest']==$row['restid'])
                           {
                            echo "<div class=\"presssubmenu\"  onclick=\" location.href='/order.php?rest=".$row['restid']."';\">";
                            echo $row['name']."</div>";
                           }
                           else
                           {
                        		echo "<div class=\"submenu\" onclick=\" location.href='/order.php?rest=".$row['restid']."';\">";
                        		echo $row['name']."</div>";
                           }
                    }
              echo"<div id='main'>";
                        
              
            }
          if($type==2)
            {
              echo"<div id='main'>";
              $result=DbConnect::queryType();
              while($row=mysql_fetch_array($result))
                    {   
                  		if(isset($_GET['style']) && $_GET['style']==$row['id'])
                        {
                            echo "<div class=\"presssubmenu\" onclick=\" location.href='/order.php?type=2&style=".$row['id']."';\">";
                        	echo $row['name']."</div>";
                        }
                  		else
                        {
                        	echo "<div class=\"submenu\" onclick=\" location.href='/order.php?type=2&style=".$row['id']."';\">";
                        	echo $row['name']."</div>";
                        }
                    }
              echo"<div id='main'>";
            }
?>

    <?php
		if(!isset($_GET['a']))
        {echo "<div class=\"submit\" onclick=\"location.href='/text.php';\">
        提交订单
    </div>";}?>
    
    
    
<div id="menu"> 

<?php

if((!isset($_GET['style']))&&(!isset($_GET['rest'])))
   {
	   $con = DbConnect::connection();
       $result = DbConnect::queryFood($con);
       echo "<table>";
       while($row=mysql_fetch_array($result))
       {
           DbConnect::orderList($row);
                 
       }
	   echo"</table>";
    
    

    
    
       mysql_close($con);
       
       
       
   	}
else if((isset($_GET['style']))&&(!isset($_GET['rest'])))
       {
	   $con = DbConnect::connection();
       $result = DbConnect::queryFoodByStyle($con,$_GET['style']);
       while($row=mysql_fetch_array($result))
       {
               DbConnect::orderList($row);
                 
       }
    
    

    
    
       mysql_close($con);
       
       
       
   	}
else if((!isset($_GET['style']))&&(isset($_GET['rest'])))
       {
	   $con = DbConnect::connection();
       $result = DbConnect::queryFoodByRest($con,$_GET['rest']);
        while($row=mysql_fetch_array($result))
       {
              DbConnect::orderList($row);
                 
       }

    
       mysql_close($con);
       
       
       
   	}
       ?>

    </div>
</body>
</html>
