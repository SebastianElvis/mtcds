<?php
class Cart{
    public function Cart() {
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }
    }
 
    /*
    添加商品
    param int $id 商品主键
          string $name 商品名称
          float $price 商品价格
          int $num 购物数量
    */
    public  function addItem($id,$num,$price) {
        //如果该商品已存在则直接加其数量
        if (isset($_SESSION['cart'][$id])) {
            $this->incNum($id,$num);
            return;
        }
        $item = array();
        $selectRestid="SELECT name FROM restaurant WHERE restid=( select restid from food where id=".$id.")";
        $selectFoodid="SELECT name FROM food where id=".$id."";
        $restQuery=mysql_query($selectRestid);
        $restaurant=mysql_fetch_array($restQuery);
        $foodQuery = mysql_query($selectFoodid);
        $foodName=mysql_fetch_array($foodQuery);
        $item['name'] = $foodName['name'];
        $item['price'] = $price;
        $item['id'] = $id;
        $item['num'] = $num;
        $item['restaurant']=$restaurant['name'];
        $_SESSION['cart'][$id] = $item;
    }
 
    /*
    修改购物车中的商品数量
    int $id 商品主键
    int $num 某商品修改后的数量，即直接把某商品
    的数量改为$num
    */
    public function modNum($id,$num) {
        if (!isset($_SESSION['cart'][$id])) {
            return false;
        }
        $_SESSION['cart'][$id]['num'] = $num;
    }
 
    /*
    商品数量+1
    */
    public function incNum($id,$num) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['num'] += $num;
        }
    }
 
    /*
    商品数量-1
    */
 
     public function decNum($id,$num) {
		if (isset($_SESSION['cart'][$id])) {
			$_SESSION['cart'][$id]['num'] -= $num;
		}

		//如果减少后，数量为0，则把这个商品删掉
		if ($_SESSION['cart'][$id]['num'] <1) {
			$this->delItem($id);
		}
	}

 
    /*
    删除商品
    */
    public function delItem($id) {
        unset($_SESSION['cart'][$id]);
    }
     
    /*
    获取单个商品
    */
    public function getItem($id) {
        return $_SESSION['cart'][$id];
    }
 
    /*
    查询购物车中商品的种类
    */
    public function getCnt() {
        return count($_SESSION['cart']);
    }
     
    /*
    查询购物车中商品的个数
    */
    public function getNum(){
        if ($this->getCnt() == 0) {
            //种数为0，个数也为0
            return 0;
        }
 
        $sum = 0;
        $data = $_SESSION['cart'];
        foreach ($data as $item) {
            $sum += $item['num'];
        }
        return $sum;
    }
 
    /*
    购物车中商品的总金额
    */
    public function getPrice() {
        //数量为0，价钱为0
        if ($this->getCnt() == 0) {
            return 0;
        }
        $price = 0.00;
        $data = $_SESSION['cart'];
        foreach ($data as $item) {
            $price += $item['num'] * $item['price'];
        }
        return sprintf("%01.2f", $price);
    }
 
    /*
    清空购物车
    */
    public function clear() {
        $_SESSION['cart'] = array();
    }
}