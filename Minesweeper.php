<?php

for ($x=0;$x<100;$x++) {
    $map[] = "0";
}

$arr = unique_rand(0, 99, 40);

foreach ($arr as $rand) {
    $map[$rand] = "M";
}

for ($i=0;$i<100;$i++) {

    if ($map[$i] == "M") {
        $map[$i] == "M";
    }

    if (is_numeric($map[$i])) {
        //左
        if ($map[$i-1] == "M" && (($i-1)%10 != 9)) {
            $map[$i]++;
        }
        //右
        if ($map[$i+1] == "M" && (($i+1)%10 != 0)) {
            $map[$i]++;
        }
        //上
        if ($map[$i-10] == "M") {
            $map[$i]++;
        }
        //下
        if ($map[$i+10] == "M") {
            $map[$i]++;
        }
        //左上
        if ($map[$i-11] == "M" && (($i-11)%10 != 9)) {
            $map[$i]++;
        }
        //右下
        if ($map[$i+11] == "M" && (($i+11)%10 != 0)) {
            $map[$i]++;
        }
        //右上
        if ($map[$i-9] == "M" && (($i-9)%10 != 0)) {
            $map[$i]++;
        }
        //左下
        if ($map[$i+9] == "M" && (($i+9)%10 != 9)) {
            $map[$i]++;
        }
    }

    if ($i % 10 == 9 && $i != 99) {
        echo $map[$i]."N";
    } else {
        echo $map[$i];
    }
}

function unique_rand($min, $max, $num) {
    $rand = array();

    for ($i=1;$i<=$num;$i++) {
        $b = rand($min, $max);

        if (!in_array($b, $rand)) {
            $rand[$i] = $b;
        } else {
            $i--;
        }
    }
    return $rand;
}
