<?php
//require 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx37d778b967a9d1c0&secret=1d2bb0ddbd3f45c193f5b5dd2cdc3910';
$access_token="u8Q1Dwr27sh5i-HmCh6MvYkAbJyLP3sCkPFQ7KEAqWkwSA7wck7AKDSW88ahAmriBMeoaGFLSnkW2_2so65wOfWenFZYsrUVXfNpCw2fbpU";
$jsonmenu = '{
    "button": 
    
    
    [
            {
            "name": "我要点餐", 
            "sub_button": [
                {
                    "type": "click", 
                    "name": "点餐说明", 
                    "key": "10"
                }, 
                {
                    "type": "click", 
                    "name": "开始点餐", 
                    "key": "1"
                }
                                
            ]
        }, 
        
        
        
        
        
        
        {
            "name": "最新活动", 
            "sub_button": [
                {
                    "type": "click", 
                    "name": "满就返", 
                    "key": "3"
                }
                
                                
            ]
        }, 
        
        
        
        
        
        
        {
        	"name": "更多精彩",
            "sub_button":[
                 {
                    "type": "click", 
                    "name": "提点建议", 
                    "key": "8"
                }, 
                 {
                    "type": "click", 
                    "name": "联系我们", 
                    "key": "9"
                }]
                }
    ]
}';
$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
$result = https_request($url, $jsonmenu);
var_dump($result);

function https_request($url,$data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

?>