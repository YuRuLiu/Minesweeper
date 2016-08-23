<?php
$time1 = microtime(true);

for ($x=0;$x<3000;$x++) {
    $map[] = "0";
}

$arr = uniqueRand(0, 2999, 1200);

foreach ($arr as $rand) {
    $map[$rand] = "M";
}

for ($i=0;$i<3000;$i++) {
    if (is_numeric($map[$i])) {
        //左
        if ($map[$i-1] == "M" && (($i-1)%60 != 59)) {
            $map[$i]++;
        }
        //右
        if ($map[$i+1] == "M" && (($i+1)%60 != 0)) {
            $map[$i]++;
        }
        //上
        if ($map[$i-60] == "M") {
            $map[$i]++;
        }
        //下
        if ($map[$i+60] == "M") {
            $map[$i]++;
        }
        //左上
        if ($map[$i-61] == "M" && (($i-61)%60 != 59)) {
            $map[$i]++;
        }
        //右下
        if ($map[$i+61] == "M" && (($i+61)%60 != 0)) {
            $map[$i]++;
        }
        //右上
        if ($map[$i-59] == "M" && (($i-59)%60 != 0)) {
            $map[$i]++;
        }
        //左下
        if ($map[$i+59] == "M" && (($i+59)%60 != 59)) {
            $map[$i]++;
        }
    }

    if ($i % 60 == 59 && $i != 2999) {
        echo $map[$i]."N";
    } else {
        echo $map[$i];
    }
}

function uniqueRand($min, $max, $num) {
    $rand = array();

    for ($i=0;$i<$num;$i++) {
        $b = mt_rand($min, $max);

        if (!in_array($b, $rand)) {
            $rand[$i] = $b;
        } else {
            $i--;
        }
    }
    return $rand;
}

$time2 = microtime(true);
//echo $time2 - $time1;
