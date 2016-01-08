<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();
//$wechatObj->valid();
$wechatObj->responseMsg();
class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

 public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
            	$type = $postObj->MsgType;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
            	if( $type == "image")
                {

                }
                else if( $type == "event")
                {
                    $msgEvent = $postObj->Event;
                    if($msgEvent == "subscribe")
                    {
                        $msgType = "text";
                        $contentStr = "欢迎关注明天吃点啥订餐平台,请点击下方菜单中的我要点餐，全部餐品进行点餐，或通过回复订餐获取点餐页面，另外我们的订餐时间是每天上午11点50到下午4点30以及下午5点30到第二天的10点50，谢谢合作";
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                   		echo $resultStr;
                    }
                    else if($msgEvent == "CLICK")
                    {
                        $EventKey = $postObj->EventKey;
                        if($EventKey == "1")
                        {
                        $newsTpl = " <xml>
 										<ToUserName><![CDATA[%s]]></ToUserName>
									 	<FromUserName><![CDATA[%s]]></FromUserName>
 										<CreateTime>%s</CreateTime>
 										<MsgType><![CDATA[news]]></MsgType>
 										<ArticleCount>1</ArticleCount>
										<Articles>
										<item>
 										<Title><![CDATA[明天吃点啥订餐页面]]></Title> 
 										<Description><![CDATA[点击开始点餐]]></Description>
										<PicUrl><![CDATA[http://mtcds-image.stor.sinaapp.com/德克士.jpg]]></PicUrl>
										<Url><![CDATA[http://mtcds.sinaapp.com/alldishes.php?username=".$fromUsername."]]></Url>
 										</item>
 										<FuncFlag>0</FuncFlag>
 										</xml> ";
                    		
                            $contentStr = "ok";
                            $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time);
                            echo $resultStr;
                        }
                        
                        if($EventKey == "3")    //最新活动-满就返
                        {
              				$msgType = "text";
                            $contentStr = "明天吃点啥代金卷重新投入使用啦~\(≧▽≦)/~消费满49元就可获赠一张，下次消费满49元可以凭代金卡抵用5元，是不是很超值呢(づ￣ 3￣)づ";
                			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                			echo $resultStr;
                    		
                        }
                        
                        
                        if($EventKey == "8")    //更多精彩-提点建议
                        {
              				$msgType = "text";
                    		$contentStr = "为了我们更好的发展，也为了能进一步为大家的服务，大家有什么好的意见建议可以向我们提出来，一经采纳，赠送无限额型代金劵10元~~（就是没要求直接花！）联系方式请看联系我们";
                			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                			echo $resultStr;
                    		
                        }
                        if($EventKey == "9")    //更多精彩-联系我们
                        {
              				$msgType = "text";
                    		$contentStr = "面向各大社团，各级学生会组织及其他团体，个人提供定制化工作餐等服务，量大从优，合作双赢，详情可在微信内留言或发邮件至1105316190@qq.com或zhangjm_sr@163.com ，期待您的关注";
                			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                			echo $resultStr;
                    		
                        }
                        if($EventKey == "10")    //我要点餐-点餐说明
                        {
              				$msgType = "text";
                    		$contentStr = "本点餐系统是明天吃点啥团队历时一个月自主研发的全自动智能点餐系统，尽显我邮学子风范有木有！多少个日夜奋战只为更好的体验，只需轻轻一点，定制餐饮即刻送达~~具体说明如下：
我们明码标价，并不另收取配送费（特殊活动除外）系统核算的价格目前只是累计价格，不含活动价格，大家这点不必担忧哦~，现阶段点餐时间为每天的11:50到16:30，以及17：30到第二天的10:50";
                			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                			echo $resultStr;
                    		
                        }
                    }
                }
            else if(!empty( $keyword ))            //keyword：?、订餐
                {
                    if($keyword=="?"){
              		$msgType = "text";
                    $contentStr = "请使用下方自定义菜单，我要点餐，全部餐品选项进行点餐";
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;}
                    if($keyword=="订餐"){
                        $newsTpl = " <xml>
 										<ToUserName><![CDATA[%s]]></ToUserName>
									 	<FromUserName><![CDATA[%s]]></FromUserName>
 										<CreateTime>%s</CreateTime>
 										<MsgType><![CDATA[news]]></MsgType>
 										<ArticleCount>1</ArticleCount>
										<Articles>
										<item>
 										<Title><![CDATA[明天吃点啥订餐页面]]></Title> 
 										<Description><![CDATA[点击开始点餐]]></Description>
										<PicUrl><![CDATA[http://mtcds-image.stor.sinaapp.com/getheadimg.jpg]]></PicUrl>
										<Url><![CDATA[http://mtcds.sinaapp.com/alldishes.php?username=".$fromUsername."]]></Url>
 										</item>
 										<FuncFlag>0</FuncFlag>
 										</xml> ";
                    		
                            $contentStr = "ok";
                            $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time);
                        echo $resultStr;
                    }
                
                if($keyword=="手游"){
                        $newsTpl = " <xml>
 										<ToUserName><![CDATA[%s]]></ToUserName>
									 	<FromUserName><![CDATA[%s]]></FromUserName>
 										<CreateTime>%s</CreateTime>
 										<MsgType><![CDATA[news]]></MsgType>
 										<ArticleCount>1</ArticleCount>
										<Articles>
										<item>
 										<Title><![CDATA[见缝插针]]></Title> 
 										<Description><![CDATA[五一特别活动哦]]></Description>
										<PicUrl><![CDATA[http://mtcds-image.stor.sinaapp.com/51.jpg]]></PicUrl>
										<Url><![CDATA[http://g.wanh5.com/xxl/core_ball/]]></Url>
 										</item>
 										<FuncFlag>0</FuncFlag>
 										</xml> ";
                    		
                            $contentStr = "ok";
                            $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time);
                        echo $resultStr;
                    }
                if($keyword=="手游2"){
                        $newsTpl = " <xml>
 										<ToUserName><![CDATA[%s]]></ToUserName>
									 	<FromUserName><![CDATA[%s]]></FromUserName>
 										<CreateTime>%s</CreateTime>
 										<MsgType><![CDATA[news]]></MsgType>
 										<ArticleCount>1</ArticleCount>
										<Articles>
										<item>
 										<Title><![CDATA[见缝插针]]></Title> 
 										<Description><![CDATA[五一特别活动哦]]></Description>
										<PicUrl><![CDATA[http://mtcds-image.stor.sinaapp.com/getheadimg.jpg]]></PicUrl>
										<Url><![CDATA[http://flash.7k7k.com/cms/cms10/20150305/1726357467/13/game.html]]></Url>
 										</item>
 										<FuncFlag>0</FuncFlag>
 										</xml> ";
                    		
                            $contentStr = "ok";
                            $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time);
                        echo $resultStr;
                    }
                
                	
                }
            
            else{
                	echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }}
		
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>