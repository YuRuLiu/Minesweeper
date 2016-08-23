<?php
header("Content-Type:text/html; charset=utf-8");
$y="";
$map = $_GET['map'];

$countN = substr_count($map, "N");

$mapWithoutN = str_replace( "N" , "" , $map);
$mapArray =  preg_split('//', $mapWithoutN, -1, PREG_SPLIT_NO_EMPTY);

$maplen = strlen($map);
$mapWithoutNLen = strlen($mapWithoutN);

if ($maplen == 109) {
    for ($x=0;$x<100;$x++) {
        $count[] = "0";
    }

    for ($i=0;$i<100;$i++) {
        if ($mapArray[$i] == "M" ) {
            $countM ++;
            $count[$i] = "M";
        }

        if(is_numeric($mapArray[$i])) {
            //左
            if ($mapArray[$i-1] == "M" && (($i-1)%10 != 9)) {
                $count[$i]++;
            }
            //右
            if ($mapArray[$i+1] == "M" && (($i+1)%10 != 0)) {
                $count[$i]++;
            }
            //上
            if ($mapArray[$i-10] == "M") {
                $count[$i]++;
            }
            //下
            if ($mapArray[$i+10] == "M") {
                $count[$i]++;
            }
            //左上
            if ($mapArray[$i-11] == "M" && (($i-11)%10 != 9)) {
                $count[$i]++;
            }
            //右下
            if ($mapArray[$i+11] == "M" && (($i+11)%10 != 0)) {
                $count[$i]++;
            }
            //右上
            if ($mapArray[$i-9] == "M" && (($i-9)%10 != 0)) {
                $count[$i]++;
            }
            //左下
            if ($mapArray[$i+9] == "M" && (($i+9)%10 != 9)) {
                $count[$i]++;
            }
        }

        if ($mapArray[$i] == $count[$i]) {
            $true = 1;
        }
        if ($mapArray[$i] != $count[$i]) {
            echo "不符合，因為數字錯。位置=".$i."正確應為".$count[$i]."<br>";
            $false = 1;
        }
    }

    if ($countN != 9) {
        echo "不符合，因為N的數量有誤";
        $false = 1;
    }

    if ($countM != 40) {
        echo "不符合，因為M的數量有誤";
        $false = 1;
    }

    if ($false) {
        exit;
    }

    if ($true) {
        echo "符合。";
    }
} else {
    echo "不符合，因為字串數量有誤";
}
