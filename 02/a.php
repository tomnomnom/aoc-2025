<?php

$in = trim(file_get_contents("input"));

$ranges = array_map(fn($r) => explode("-", $r), explode(",", $in));

$a = 0;
foreach ($ranges as $range){
    $start = intval($range[0]);
    $end = intval($range[1]);

    for ($i = $start; $i <= $end; $i++){
        $s = strval($i);
        if (strlen($s) % 2 != 0) continue;
        $p = str_split($s, strlen($s)/2);
        if ($p[0] == $p[1]) $a += $i;
    }

}

echo $a;



