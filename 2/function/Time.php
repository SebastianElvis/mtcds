<?php
class Time{
    static public function getTimeLevel(){
		$now= date("Y-m-d H:i:s");
		$d = date("d");
        $m = date("m");
        $y = date("Y");
		$time1=mktime(10,50,00, $m, $d, $y);
		$time2= mktime(11,50,00,$m,$d,$y);
        $time5= mktime(12,50,00,$m,$d,$y);
        $time3= mktime(16,30,00,$m,$d,$y);
        $time4= mktime(17,30,00,$m,$d,$y);
        $time6= mktime(18,30,00,$m,$d,$y);
		$nowtime= strtotime($now);
		if($nowtime<$time1){
			return 1;
        }
        else if($nowtime>=$time1 and $nowtime<$time2)
        {
            return 2;
        }
        else if($nowtime>=$time2 and $nowtime<$time5)
        {
            return 6;
        }
        else if($nowtime>=$time5 and $nowtime<$time3)
        {
            return 3;
        }
        else if($nowtime>=$time3 and $nowtime<$time4)
        {
            return 4;
        }
        else if($nowtime>=$time4 and $nowtime<$time6)
        {
            return 7;
        }
        else
        {
            return 5;
        }
    }
}
class Time1{
    static public function getTimeLevel(){
		$now= date("Y-m-d H:i:s");
		$d = date("d");
        $m = date("m");
        $y = date("Y");
		$time1=mktime(10,50,00, $m, $d, $y);
		$time2= mktime(11,50,00,$m,$d,$y);
        $time3= mktime(16,30,00,$m,$d,$y);
        $time4= mktime(17,30,00,$m,$d,$y);

		$nowtime= strtotime($now);
		if($nowtime<$time1){
			return 1;
        }
        else if($nowtime>=$time1 and $nowtime<$time2)
        {
            return 2;
        }
        else if($nowtime>=$time5 and $nowtime<$time3)
        {
            return 3;
        }
        else if($nowtime>=$time3 and $nowtime<$time4)
        {
            return 4;
        }
        else
        {
            return 5;
        }
    }
}
?>