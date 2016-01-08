<?php session_start();
require_once './function/DbConnect.php';
require_once './function/Time.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTDDbConnect XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    </head>
    <body>
        <form action = "./insert.php" method = "post">
        <table>
            <tr>
                <td>名字</td><td><input type="text" name = "name"></td></tr>
            <tr>
                <td>性别</td><td><select name="sex"><option value = "1">男</option><option value="2">女</option></select></td></tr>
            <tr><td>宿舍楼</td><td><select name="apartment"><option value="0"></option><option value = "学一">学一</option><option value = "学二">学二</option>
                <option value = "学三">学三</option><option value = "学四">学四</option><option value = "学五">学五</option>
                <option value = "学六">学六</option><option value = "行政楼">行政楼</option></select></td></tr>
            <tr><td>宿舍号</td><td><input type="text" name = "number"></td></tr>
            <tr><td>手机</td><td><input type="text" name = "telephone"></td></tr>
            
        </table>
        <input type = "submit" name = "submit" value="提交">
        </form>
    </body>
</html>