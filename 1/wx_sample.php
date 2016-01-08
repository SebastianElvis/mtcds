<?php
define("TOKEN","weixin");
function checkSignature(){
    $signature = $_GET['signature'];
    $nonce = $_GET['nonce'];
    $timestamp = $_GET['timestamp'];    
    $tmpArr = array ($nonce,$timestamp,TOKEN);
    sort ( $tmpArr);
    $tmpStr = implode($tmpArr);
    $tmpStr = shal($tmpStr);
    if($tmpStr == $signature){
        return true;
    }
    return false;
}
if ( false == checkSignature()){
    exit(0);
}
$echoStr = $_GET['echostr'];
if ($echostr){
    echo $echostr;
    exit(0);
}
?>