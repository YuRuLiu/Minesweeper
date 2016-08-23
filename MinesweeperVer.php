<?php
header("Content-Type:text/html; charset=utf-8");
$y="";
$map = $_GET['map'];

$countN = substr_count($map, "N");
//echo $countN;

$mapWithoutN = str_replace( "N" , "" , $map);
$mapArray =  preg_split('//', $mapWithoutN, -1, PREG_SPLIT_NO_EMPTY);
//var_dump($mapArray);

$maplen = strlen($mapWithoutN);

for ($x=0;$x<$maplen;$x++) {
    $count[] = "0";
}

for ($i=0;$i<$maplen;$i++) {
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
        $false = 1;
        echo "不符合，因為數字錯。位置=".$i."<br>";
    }
}

if ($false) {
    exit;
}

if ($true) {
    echo "符合。";
}



