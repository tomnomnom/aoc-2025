<?php

$in = trim(file_get_contents("input"));

$ranges = array_map(fn($r) => explode("-", $r), explode(",", $in));

$a = 0;
foreach ($ranges as $range){
    $start = intval($range[0]);
    $end = intval($range[1]);

    for ($i = $start; $i <= $end; $i++){
        $s = strval($i);
        for ($j = 1; $j <= strlen($s)/2; $j++){

            $p = str_split($s, $j);
            if (sizeOf($p) < 2) continue; 
            if (sizeOf(array_unique($p)) == 1){
                $a += $i;
                break;
            }
        }
    }

}

echo $a;



