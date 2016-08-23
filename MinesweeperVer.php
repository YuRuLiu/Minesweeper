<?php
header("Content-Type:text/html; charset=utf-8");

$map = substr($_SERVER['QUERY_STRING'], 4);

$maplen = strlen($map);
if ($maplen != 109) {
    echo "不符合，因為字串長度為".$maplen."，正確長度應為109個字元。";
    $false = 1;
}

if (preg_match("/m/", $map)) {
    echo "地雷大小寫有錯，m須為大寫。";
    $false = 1;
}

$countM = substr_count($map, "M");
$countm = substr_count($map, "m");
$totalM = $countM + $countm;
if ($totalM != 40) {
    echo "地雷數量有錯，地雷數量為".$totalM."顆，正確應為40顆。";
    $false = 1;
}

if (preg_match("/n/", $map)) {
    echo "不符合，N須為大寫。";
    $false = 1;
}

$countN = substr_count($map, "N");
if ($countN != 9) {
    echo "斷行次數錯誤，斷行次數為".$countN."，正確應為9。";
    $false = 1;
}

$mapWithoutN = str_replace( "N" , "" , $map);
$mapArray =  preg_split('//', $mapWithoutN, -1, PREG_SPLIT_NO_EMPTY);

for ($x=0;$x<100;$x++) {
    $count[] = "0";
}

for ($i=0;$i<100;$i++) {

    if ($mapArray[$i] == "M" || $mapArray[$i] == "m") {
        $count[$i] = "M";
    }

    if(is_numeric($mapArray[$i])) {
        //左
        if (($mapArray[$i-1] == "M" || $mapArray[$i-1] == "m") && (($i-1)%10 != 9)) {
            $count[$i]++;
        }
        //右
        if (($mapArray[$i+1] == "M" || $mapArray[$i+1] == "m") && (($i+1)%10 != 0)) {
            $count[$i]++;
        }
        //上
        if ($mapArray[$i-10] == "M" || $mapArray[$i-10] == "m") {
            $count[$i]++;
        }
        //下
        if ($mapArray[$i+10] == "M" || $mapArray[$i+10] == "m") {
            $count[$i]++;
        }
        //左上
        if (($mapArray[$i-11] == "M" || $mapArray[$i-11] == "m") && (($i-11)%10 != 9)) {
            $count[$i]++;
        }
        //右下
        if (($mapArray[$i+11] == "M" || $mapArray[$i+11] == "m") && (($i+11)%10 != 0)) {
            $count[$i]++;
        }
        //右上
        if (($mapArray[$i-9] == "M" || $mapArray[$i-9] == "m") && (($i-9)%10 != 0)) {
            $count[$i]++;
        }
        //左下
        if (($mapArray[$i+9] == "M" || $mapArray[$i+9] == "m") && (($i+9)%10 != 9)) {
            $count[$i]++;
        }
    }

    if ($mapArray[$i] == $count[$i]) {
        $true = 1;
    }
    if ($mapArray[$i] != $count[$i]) {
        echo "數字對應有錯。位置".$i."：".$mapArray[$i]."，正確應為".$count[$i]."。";
        $false = 1;
    }
}

if ($false) {
    exit;
}

if ($true && !$false) {
    echo "正確的。";
}
