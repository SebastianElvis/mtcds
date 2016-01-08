<?php		//get post data, May be due to the different environments

                $fromUsername = 'oZUx9jmiyeyvdDozFnHVJjQxdF70';
                $toUsername = 'gh_293a1e2b51a9';
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
                        $msgType = "text";
                        $contentStr = "欢迎关注明天吃点啥订餐平台,请点击下方菜单中的我要点餐，全部餐品进行点餐，或通过回复订餐获取点餐页面，另外我们的订餐时间是每天上午11点50到下午4点30以及下午5点30到第二天的10点50，谢谢合作";
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                   		echo $resultStr;
?>