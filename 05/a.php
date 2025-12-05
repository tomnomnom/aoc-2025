<?php

$lines = array_map("trim", file("input"));

$ranges = [];
while(true){
    $line = trim(array_shift($lines));
    if ($line == "") break;
    $ranges[] = array_map("intval", explode("-", $line));
}

$ingredients = array_map("intval", $lines);

function inRange($range, $ingredient){
    return (
        $ingredient >= $range[0] &&
        $ingredient <= $range[1]
    ); 
}

function inRanges($ranges, $ingredient){
    foreach ($ranges as $range){
        if (inRange($range, $ingredient)) return true;
    }
    return false;
}

$ingredients = array_filter($ingredients, fn($i) => inRanges($ranges, $i));

echo sizeOf($ingredients).PHP_EOL;
