<?php

$banks = array_map(
    fn($row) => array_map(
        fn($b) => intval($b),
        str_split(trim($row))
    ),
    file("input")
);

function biggest($bank){
    
    $b = 0;
    $bi = 0;
    for ($i = 0; $i < sizeOf($bank); $i++){
        if ($bank[$i] > $b){
            $b = $bank[$i];
            $bi = $i;
        }
    }

    return [$b, $bi];
}

$a = 0;
foreach ($banks as $bank){
    list($msd, $bi) = biggest(array_slice($bank, 0, -1));
    list($lsd, $r) = biggest(array_slice($bank, $bi+1));

    $bank = implode("", $bank);
    echo "{$bank}: {$msd}{$lsd}\n";

    $a += intval(sprintf("%d%d", $msd, $lsd));
}


echo $a;
