<?php

$lines = array_map(
    fn($l) => preg_split("/\s+/", trim($l)),
    file("input")
);

$operators = array_pop($lines); 

$total = 0;
for ($i = 0; $i < sizeOf($operators); $i++){
    $op = $operators[$i]; 
    $a = $lines[0][$i];
    for ($j = 1; $j < sizeOf($lines); $j++){
        if ($op == "+"){
            $a += $lines[$j][$i];
        } else if ($op == "*"){
            $a *= $lines[$j][$i];
        }
    }
    $total += $a;
}

echo $total.PHP_EOL;


