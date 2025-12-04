<?php

$banks = array_map(
    fn($row) => array_map(
        fn($b) => intval($b),
        str_split(trim($row))
    ),
    file("input")
);

function biggest($bank, $start, $leave){
    
    $b = 0;
    $bi = 0;
    for ($i = $start; $i < sizeOf($bank)-$leave; $i++){
        if ($bank[$i] > $b){
            $b = $bank[$i];
            $bi = $i;
        }
    }

    return [$b, $bi];
}

$a = 0;
foreach ($banks as $bank){

    $digits = "";
    $s = -1;

    for ($i = 0; $i < 12; $i++){
        // in hindsight this is much easier than messing with array_slice (:
        list($d, $s) = biggest($bank, $s+1, 11-$i);
        $digits .= $d;
    }

    $a += intval($digits);
}

echo $a;
