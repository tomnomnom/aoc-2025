<?php
$lines = array_map(
    fn($line) => array_map(
        fn($c) => [
            "S" => 1,
            "." => 0,
            "^" => "^",
        ][$c],
        str_split(trim($line))
    ),
    file("input")
);

// This is one of those ones where if I knew some maths I would
// probably have a much easier time!
$prev = array_shift($lines);

foreach ($lines as &$line){
    for ($x = 0; $x < sizeOf($line); $x++){

        $p = $prev[$x];
        if (!is_numeric($p)) continue;

        if ($line[$x] != "^"){
            $line[$x] += $p;
            continue;
        }

        $line[$x-1] += $p;
        $line[$x+1] = $p;
    } 

    $prev = $line;
}

$row = array_filter(array_pop($lines), "is_numeric");
echo array_sum($row);


