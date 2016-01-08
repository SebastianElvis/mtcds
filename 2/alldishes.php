<?php
session_start();
if(isset($_SESSION['cart'])){
    session_unset($_SESSION['cart']);
}
if(isset($_SESSION['cart1'])){
    session_unset($_SESSION['cart1']);
}
$_SESSION['openid']=$_GET['username']; //按微信号识别


													//背景图片代码    
?>
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
            .box{width:23%;height:13%; background:#09F;-moz-border-radius:30px;-webkit-border-radius:30px;border-radius: 20px;text-align:center; line-height:80px;}
            .logo{
                filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true,sizingMethod=scale,src="http://mtcds-image.stor.sinaapp.com/1.png");
                width:70px;height:23px;
            }
      
        </style>
        
        
        
        <link rel="stylesheet" type="text/css" href="FlexSlider/flexslider.css" /> 
        <script type="text/javascript" src="function/jquery-1.6.2.min.js"></script> 
        <script type="text/javascript" src="FlexSlider/jquery.flexslider-min.js"></script> 
        
        
        <script type="text/javascript" charset="utf-8">
  		$(window).load(function() {
 $('.flexslider').flexslider({
  animation: "fade",              //String: Select your animation type, "fade" or "slide"图片变换方式：淡入淡出或者滑动
  slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"图片设置为滑动式时的滑动方向：左右或者上下
  slideshow: true,                //Boolean: Animate slider automatically 载入页面时，是否自动播放
  slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds 自动播放速度毫秒
  animationDuration: 600,         //Integer: Set the speed of animations, in milliseconds动画淡入淡出效果延时
  directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)是否显示左右控制按钮
  controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage是否显示控制菜单
  keyboardNav: true,              //Boolean: Allow slider navigating via keyboard left/right keys键盘左右方向键控制图片滑动
  mousewheel: false,              //Boolean: Allow slider navigating via mousewheel鼠标滚轮控制制图片滑动
  prevText: "Previous",           //String: Set the text for the "previous" directionNav item
  nextText: "Next",               //String: Set the text for the "next" directionNav item
  pausePlay: false,               //Boolean: Create pause/play dynamic element
  pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
  playText: 'Play',               //String: Set the text for the "play" pausePlay item
  randomize: false,               //Boolean: Randomize slide order 是否随即幻灯片
  slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)初始化第一次显示图片位置
  animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end 是否循环滚动
  pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
  pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
  controlsContainer: "",          //Selector: Declare which container the navigation elements should be appended too. Default container is the flexSlider element. Example use would be ".flexslider-container", "#container", etc. If the given element is not found, the default action will be taken.
  manualControls: "",             //Selector: Declare custom control navigation. Example would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.自定义控制导航
  manualControlEvent:"",          //String:自定义导航控制触发事件:默认是click,可以设定hover
  start: function(){},            //Callback: function(slider) - Fires when the slider loads the first slide
  before: function(){},           //Callback: function(slider) - Fires asynchronously with each slider animation
  after: function(){},            //Callback: function(slider) - Fires after each slider animation completes
  end: function(){}               //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
  
 });
});
		</script>
        
    </head>
    
    <body>
        
<?php    
/*
if(strcmp($_GET['username'],'oZUx9jiZVMqe3iNB9NxNqzvHpRTc')==0){
    echo"<p>   <script language=\"javascript\">   alert(\"请通过关注微信平台liankexinda进行点餐，通过浏览器点餐目前无法识别。\");   </script>   </p>";
}
if(!isset($_GET['username']))
{
    echo"<p>   <script language=\"javascript\">   alert(\"请通过关注微信平台liankexinda进行点餐，通过浏览器点餐目前无法识别。\");   </script>   </p>";
    exit();
}
*/
require_once './function/DbConnect.php';
$username= $_GET['username'];
$con = DbConnect::connection();

$status=DbConnect::getStatus($con);
														/*停止系统：将false改为true*/
//echo $status;
if( (!DbConnect::queryAdmin($username)) ){
    
    if($status==3){
        echo"<p>   <script language=\"javascript\">   alert(\"这学期已经停业啦~~~大家好好准备期末考试哦\");   </script>   </p>";
        exit();
    }
}

/*
echo "<div style=\" 
left:1%;
border-radius: 5px;
position:absolute;
top:0; 
width:98%; 
height:250px;\">
<img style=\"width:100%; height:100%;\" src=\"images/麦趣鸡盒2.jpg\">
</div>";
*/

echo '<div style="position:absolute; left:20%; width:60%; top:4%; height:5%; line-height:5%; text-align:center;">
    <font color=black size=2px >明天吃点啥团队竭诚为您服务</font>
    
    </div>';

echo '<div class="flexslider" style="position:absolute; top:7%; width:90%; left:5%; height:250px; overflow:hidden"> 
      <ul class="slides"> 
        <li><img src="./images/麦趣鸡盒3.jpg" /></li> 
        <li><img src="./images/认真.jpg" /></li> 
        <li><img src="./images/daijinka.jpg" /></li> 
      </ul> 
</div> ';

/*
echo "<div style=\"
position:absolute;
top=260px;
left=10px;
height=20px;
line-height=20px;
\">
<b>公告：今天下雨但是依然正常营业哦<br/>
我们的配送团队依然会将餐品保质保量地送到宿舍<br/>谢谢大家的支持٩(๑`^´๑)۶
<br/>2015.4.2</b>
</div>";
*/

if(DbConnect::queryAdmin($username)&&!isset($_GET['action'])) //管理员界面
{
    $row = DbConnect::selectByOpenId("name",$username);
    echo "<div style=\" -moz-border-radius:30px;-webkit-border-radius:30px;border-radius: 5px;position:absolute;color:#000;background:#ffffff;bottom:0; width:97%; height:80px;\">";
    echo "个人信息:<br/>".$row['name'];
    echo "</br>";
    echo "默认地址: ";
    $row = DbConnect::selectByOpenId("apartment, number, telephone",$username);
    echo $row['apartment']."楼".$row['number'];
    echo "</br>";
    echo "手机号：";
    echo $row['telephone']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;平台运行状态:$status";
    echo "</div>";
    echo "<div class=\"box\" style=\" position:absolute;background:rgb(255,0,0);  left:1%;top:56%;  boder:1px solid;\" onclick=\" location.href='order.php?rest=4';\">开始点餐</div>";
    echo "<div class=\"box\" style=\" position:absolute;background:#66cc00;  to(rgb(255, 255,255)));  top:56%;  right:1%; boder:1px solid;\"onclick=\" location.href='modify.php';\">修改送餐地址</div>";
    echo "<div class=\"box\" style=\" position:absolute;  background:#0066ff;   top:56%; left:26% ;boder:1px solid;\" onclick=\" location.href='deliver.php';\">内部界面</div>";
    echo "<div class=\"box\" style=\" position:absolute; background:#ffd700; top:56%; right:26%; boder:1px solid;\" onclick=\" location.href='myorder.php';\">查看已下订单</div>";
    echo "<div class=\"box\" style=\" position:absolute; background:#ffd700; top:71%; left:1%; boder:1px solid;\" onclick=\" location.href='comments.php?username=$username'; \">用户评价</div>";
    if($username=='oZUx9jm9rFmgf--TRVFoRMFpkzXY' || $username=='oZUx9jkw7wFL1f8rX5UOdoVgmF4k') echo "<div class=\"box\" style=\" position:absolute; background:#000000; top:71%; right:1%; boder:1px solid;\" onclick=\" location.href='changeStatus.php'; \">改变平台运营状态</div>";
    //echo "<div class=\"box\" style=\" position:absolute; background:#ffd700; top:71%; left:1%; boder:1px solid;\" onclick=\" location.href='packageOrder.php';\">套餐界面</div>";
    //echo "<div class=\"box\" style=\" position:absolute; background:#ffd700; top:71%; left:1%; boder:1px solid;\" onclick=\" location.href='myorder.php';\">订餐提醒</div>";
    //echo "<div class=\"box\" style=\" position:absolute; background:#ffd700; top:71%; right:26%; boder:1px solid;\" onclick=\" location.href='NewPackage.php';\">创建套餐</div>";
}

else if(DbConnect::queryByUsername($username,$con)&&!isset($_GET['action']))    //用户界面
{

    $row = DbConnect::selectByOpenId("name",$username);
    echo "<div style=\" -moz-border-radius:30px;-webkit-border-radius:30px;border-radius: 5px;position:absolute;color:#000;background:#ffffff;bottom:0; width:97%; height:80px;\">";
    echo "个人信息:<br/>".$row['name'];
    echo "</br>";
    echo "默认地址: ";
    $row = DbConnect::selectByOpenId("apartment, number, telephone",$username);
    echo $row['apartment']."楼".$row['number'];
    echo "</br>";
    echo "手机号：";
    echo $row['telephone'];
    echo "</div>";
    echo "<div class=\"box\" style=\" position:absolute; background:rgb(255,0,0);  top:56%;left:1%;  boder:1px solid;\" onclick=\" location.href='order.php?rest=1';\">开始点餐</div>";
    echo "<div class=\"box\" style=\" position:absolute;background:#66cc00;  top:56%;  right:1%; boder:1px solid;\"onclick=\" location.href='modify.php';\">修改送餐地址</div>";
    //echo "<div class=\"box\" style=\" position:absolute; background:#0066ff;   top:56%; left:26% ;boder:1px solid;\" onclick=\" location.href='introduction.php';\">使用说明</div>";
    echo "<div class=\"box\" style=\" position:absolute; background:#ffd700;  top:56%; left:26%; boder:1px solid;\" onclick=\" location.href='myorder.php';\">查看已下订单</div>";
    echo "<div class=\"box\" style=\" position:absolute; background:#ffd700; top:56%; right:26%; boder:1px solid;\" onclick=\" location.href='comments.php?username=$username'; \">用户评价</div>";
    //echo "<div class=\"box\" style=\" position:absolute; background:#ffd700; top:71%; left:1%; boder:1px solid;\" onclick=\" location.href='packageOrder.php';\">套餐界面</div>";
}
else   
{
       
    //进入注册页面modify.php
    echo "<div style=\" -moz-border-radius:30px;-webkit-border-radius:30px;border-radius: 5px;position:absolute;color:#000;background:#ffffff;bottom:0; width:97%; height:80px;\">";
    echo "您好，点餐前请先输入订餐信息，输入前可以查看菜单，但不能点餐";
    echo "</div>";
    echo "<div class=\"box\" style=\" position:absolute; background:rgb(255,0,0); left:1%;top:56%;  boder:1px solid;\" onclick=\" location.href='modify.php';\">输入订餐信息</div>";
    echo "<div class=\"box\" style=\" position:absolute;background:#66cc00;  top:56%;  right:1%; boder:1px solid;\"onclick=\" location.href='order1.php';\">查看菜单</div>";
    echo "<div class=\"box\" style=\" position:absolute; background:#0066ff;  top:56%; left:26% ;boder:1px solid;\" onclick=\" location.href='introduction.php';\">使用说明</div>";
    echo "<div class=\"box\" style=\" position:absolute; background:#ffd700; top:56%; right:26%; boder:1px solid;\" onclick=\" location.href='myorder.php';\">查看已下订单</div>";
 
        ?>
        <?php
}
?>
    </body>
</html>