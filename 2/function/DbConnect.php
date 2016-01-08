<?php
class DbConnect{
	static public function connection()
	{
    	$con = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		return $con;
	}
    static public function queryByUsername($username,$con)
    {
    		mysql_select_db("app_mtcds", $con);
            $result = mysql_query("SELECT * FROM user where username = '".$username."'");
            while($row = mysql_fetch_array($result))
            {
                return true;
            }
            return false;
	}
	static public function insertByUsername($openid,$name,$sex,$apartment,$number,$telephone,$con)
    {
        mysql_select_db("app_mtcds",$con);
        $result=mysql_query("select * from user where username='".$openid."'");
        $num_rows = mysql_num_rows($result);
        if($num_rows==1)
        {
            mysql_query("update user set name='".$name."',sex='".$sex."',apartment='".$apartment."',number='".$number."',telephone='".$telephone."' where username='".$openid."'");
        }
        else
        {
            mysql_query("insert into user (username, name, sex, apartment, number, telephone) value('".$openid."','".$name."','".$sex."','".$apartment."','".$number."','".$telephone."')");
        }
        mysql_close($con);
    }
	static public function selectByOpenId($dataColumn,$openId)
    {
        $con = DbConnect::connection();
        mysql_select_db("app_mtcds",$con);
        $result = mysql_query("SELECT ".$dataColumn." FROM user where username = '".$openId."'");
        return mysql_fetch_array($result);
    }
    static public function queryFood($con){
        mysql_select_db("app_mtcds",$con);
        $result = mysql_query("SELECT * FROM food order by restid limit 0,10");
        return $result;
    }
    static public function queryFoodByRest($con,$rest){
        mysql_select_db("app_mtcds",$con);
        $result = mysql_query("SELECT * FROM food where restid='".$rest."'order by price asc");
        return $result;
    }
    static public function queryFoodByStyle($con,$style){
        mysql_select_db("app_mtcds",$con);
        $result = mysql_query("SELECT * FROM food where type='".$style."' order by price asc");
        return $result;
    }
    static public function queryFoodById($con,$id){
        mysql_select_db("app_mtcds",$con);
        $result = mysql_query("SELECT * FROM food where id='".$id."'");
        return $result;
    }
    static public function queryAdmin($username)
    {
        $con = DbConnect::connection();
        mysql_select_db("app_mtcds",$con);
        $result = mysql_query("SELECT * FROM admin where username='".$username."'");
        while($row = mysql_fetch_array($result))
        {
            return true;
        }
        return false;
    }
    static public function orderList($row)
    {
               $id=$row['id'];
               if(isset($_SESSION['cart'][$id]['num']))
               {
                   echo"<div class=\"item\">
                   
                   <div class=\"infor\">
                   <p>".$row['name']."</p>
                   <p style=\" color: #ff0000;\">".$row['price']."</p>                 <!-- 名字、价格 -->
                   </div>
                   
                   <div class=\"pic\"><img class=\"itempic\" src='http://mtcds-foodimage.stor.sinaapp.com/".$id.".jpg'></div>          <!-- 图片 -->
                   
                   
                   <div class=\"plus\">
                    	
                        <div style=\"height:60%; position:absolute; bottom:0px;\">                       <!-- 减 -->
                        <IMG style=\"height:100%;\" 
                        onclick=' 
                        	if (document.getElementById(\"".$row['id']."\").value>0){
                            	document.getElementById(\"".$row['id']."\").value--;
                                getNews(".$row['id'].",2,".$row['price'].");
                                }' 
	      				src=\"images/remove _ denied.png\" > 
                        </div>
                    
                    	<div style=\"  position:absolute; left:20%;width:40%; bottom:0px;\" >      <!-- 总数 -->
                    	<INPUT id=".$row['id']." 
                        style=\"WIDTH: 60%; TEXT-ALIGN: right\" 
                        maxLength=4 
		  				value=".$_SESSION['cart'][$id]['num']." 
                        name=cart_quantity>
                    	</div> 
                    
		  				<div style=\"height:60%; position:absolute; bottom:0px; left:60%;\">              <!-- 加 -->
                        <IMG style=\"height:100%;\"
                        onclick='
                        	document.getElementById(\"".$row['id']."\").value++;
                            getNews(".$row['id'].",1,".$row['price'].");' 
		  				src=\"images/add.png\" >
                    	</div>
                    
                    </div>";  
                   
                   echo "</div>";
               }
          	   else
               {
                   echo"<div class=\"item\">
                   
                   <div class=\"infor\">
                   <p>".$row['name']."</p>
                   <p style=\"color: #ff0000;\">".$row['price']."</p>
                   </div>
                   
                   <div class=\"pic\"><img class=\"itempic\" src='http://mtcds-foodimage.stor.sinaapp.com/".$id.".jpg'></div>
    	  			
                   <div class=\"plus\">
                    
                    	<div style=\"height:60%; position:absolute; bottom:0px;\">
                        <IMG style=\"height:100%;\" 
                        onclick='
                        if (document.getElementById(\"".$row['id']."\").value>0){
                        	document.getElementById(\"".$row['id']."\").value--;
                            getNews(".$row['id'].",2,".$row['price'].");
                            }' 
	      				src=\"images/remove _ denied.png\" > 
                    	</div>
                        
                        <div style=\"  position:absolute; left:20%;width:40%; bottom:0px;\" >
                        <INPUT id=".$row['id']." 
                        style=\"WIDTH: 60%; TEXT-ALIGN: right\" 
                        maxLength=4 
		  				value=0 name=cart_quantity>
                        </div> 
                        
		  				<div style=\"height:60%; position:absolute; bottom:0px; left:60%;\"><IMG style=\"height:100%;\" 
                        onclick='document.getElementById(\"".$row['id']."\").value++;getNews(".$row['id'].",1,".$row['price'].");' 
		  				src=\"images/add.png\" >
                        </div>
                        
                   </div>";    
                   
                   echo "</div>";
               }
        echo"<script language=\"javascript\"> imgs=document.getElementsByTagName(\"img\"); for (var i=0; i<imgs.length; i++) { if (imgs[i].width>138) { imgs[i].width=138; } } </script> ";
    }
    static public function queryRest($status){
        $con = DbConnect::connection();
        mysql_select_db("app_mtcds",$con);
        $sql = "select * from restaurant";                                     /////////////////////////////////////////////////////////////////
        $result = mysql_query("select * from restaurant WHERE marketid<=$status ORDER BY marketid,restid");
        return $result;
    }
    static public function queryType(){
        $con = DbConnect::connection();
        mysql_select_db("app_mtcds",$con);
        $sql = "select * from type";
        $result = mysql_query("select * from type");
        return $result;        
    }
    
    static public function getStatus($con){
        mysql_select_db("app_mtcds", $con);
        $result = mysql_query("select * from config WHERE Config='Status'");
        $row=mysql_fetch_array($result);
        return $row['runtime'];
    }
}



class manager{
    static public function manageCost($con){
        mysql_select_db("app_mtcds", $con);
        $result = mysql_query("SELECT food.id as ida,food.name as namea,cost,restaurant.name as nameb FROM food,restaurant where restaurant.restid=food.restid order by food.restid,cost");
        echo "<table> <tr><td>食品名</td><td>餐厅名</td><td>进价</td></tr>";    
        while($row = mysql_fetch_array($result))
            {
            echo "<tr><td>".$row['namea']."</td><td>".$row['nameb']."</td>
                   <td>
                    <INPUT id=".$row['ida']." value=".$row['cost'].">
                    </td><td><input  type=\"button\" onclick=\"location.href='/manager.php?id=".$row['ida']."&action=modifyCost&cost='+document.getElementById('".$row['ida']."').value+''\" value=\"修改\" /> </tr>";
  
            }
        echo "</table>";
    }
    static public function modifyCost($id,$cost){
        $con=DbConnect::connection();
        mysql_select_db("app_mtcds", $con);
        $result=mysql_query("update food set cost=".$cost." where id=".$id."");
    }
    static public function modifyPrice(){
    	echo "<form action=\"manager.php?action=modifyPrice\" method=\"post\"><select name=\"rest\">";
        $con = DbConnect::connection();
        mysql_select_db("app_mtcds",$con);
        $result = mysql_query("select * from restaurant");
        while($row = mysql_fetch_array($result))
        {
            echo "<option value=".$row['restid']."> ".$row['name']."</option>";
        }
        echo"</select>";
        echo"<select name=\"type\">";
        $result = mysql_query("select * from type");
        while($row = mysql_fetch_array($result))
        {
            echo "<option value=".$row['id']."> ".$row['name']."</option>";
        }
        echo "</select>";
        echo "<input type='text' name='number'>";
        echo "<input type='submit' value='提交'>";
        echo "</form>";
    }
    
    
}
        
?>