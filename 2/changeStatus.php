<?php
header("Content-type: text/html; charset=utf-8"); 
require_once './function/DbConnect.php';
$con = DbConnect::connection();
mysql_select_db("app_mtcds", $con);

$queryStatus=mysql_query("SELECT * FROM config WHERE Config='Status'");
    $StatusArray=mysql_fetch_array($queryStatus);
    $Status=$StatusArray['runtime'];

if(!isset($_GET['type'])){
echo "<br/><br/>改变运营状态为：
</br></br>
		<ul>
            <li><a href=\"changeStatus.php?type=1\">&nbsp;&nbsp;&nbsp;&nbsp;只有近途</a></li>
            </br></br>
            <li><a href=\"changeStatus.php?type=2\">&nbsp;&nbsp;&nbsp;&nbsp;正常运营</a></li>
            </br></br>
            <li><a href=\"changeStatus.php?type=3\">&nbsp;&nbsp;&nbsp;&nbsp;平台关闭</a></li>
        </ul>";
    
    echo "<div style=\"position:absolute; bottom:30%; right:20%; width:20%; height:30%;\">
    目前平台运营状态：";
    echo $Status;
    echo "<br/>1只有近途<br/>2:正常运营<br/>3:平台关闭";    
    echo "</div>";    
    
}


else {
   	$type=$_GET['type'];
    $changeStatus="UPDATE config
    SET runtime=$type
    WHERE Config='Status'";
    mysql_query($changeStatus);
    
    $queryStatus=mysql_query("SELECT * FROM config WHERE Config='Status'");
    $StatusArray=mysql_fetch_array($queryStatus);
    $Status=$StatusArray['runtime'];
    
    echo "平台状态已改为",$Status;
    
}


        

?>