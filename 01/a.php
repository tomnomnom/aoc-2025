<?php

function mod($n, $m){
    return (($n % $m) + $m) % $m;
}

$rows = file("input");

$pos = 50;
$c = 0;

foreach($rows as $row){
    $row = trim($row);
    $d = substr($row, 0, 1);
    $n = intval(substr($row, 1));

    switch ($d){
    case "L":
        $pos -= $n;
        break;
    case "R":
        $pos += $n;
        break;
    }

    $pos = mod($pos, 100);

    echo $pos.PHP_EOL;

    if ($pos == 0) $c++;
}

echo "pw: " . $c . PHP_EOL;
