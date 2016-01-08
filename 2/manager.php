<?php
require_once './function/DbConnect.php';
require_once './function/Time.php';
require_once './function/management.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTDDbConnect XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title></title>
<script type="text/javascript">
function ChangeSelect(obj){
  var n = obj.selectedIndex; //获取第一个列表中选中的项的序列
  var val = obj.options[n].value;  //获取第一个列表中选择的项的值
  if(val==2){  //如果选择的值是 2 
   document.myform.select2.options.length = 0; //初始化select2
   for(i=0;i<4;i++){ //给第三个select创建四个项
   document.myform.select2.options[i] = new Option("选择项"+i,i+1); //Option() 的参数： 前一个是显示名，后一个是值
   }
  }
  //你可以继续添加判断值，然后新重新初始化select2，再给select2进行项的添加操作
}
</script>
</head>
<body>    
<?php
if(strcmp($_GET['action'],"modifyCost")==0)
{
if(isset($_GET['cost']))
{
    manager::modifyCost($_GET['id'],$_GET['cost']);
}
$con=DbConnect::connection();
manager::manageCost($con);
}
if(strcmp($_GET['action'],"modifyPrice")==0)
{
    manager::modifyPrice();   
}
?>
 
</body>
</html>
