<?php

$grid = array_map(fn($row) => str_split(trim($row)), file("input"));

function isEmpty($grid, $x, $y){
    if (!isset($grid[$y])) return true;
    if (!isset($grid[$y][$x])) return true;
    return $grid[$y][$x] != "@";
}

function isAccessible($grid, $x, $y){
    $dirs = [
        // top
        [-1, -1],
        [0, -1],
        [1, -1],

        // Inline
        [-1, 0],
        [1, 0],

        // Bottom
        [-1, 1],
        [0, 1],
        [1, 1],
    ];

    $e = 0;
    foreach ($dirs as $dir){
        list($dx, $dy) = $dir;
        if (isEmpty($grid, $x+$dx, $y+$dy)) $e++;
    }

    return $e > 4;
}

$a = 0;

foreach ($grid as $y => $row){
    foreach ($row as $x => $v){
        if ($v != "@") continue;
        if (isAccessible($grid, $x, $y)) $a++;
    }
}

echo $a;
