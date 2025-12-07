<?php
$lines = array_map(fn($l) => str_split(trim($l)), file("input"));

$prev = array_shift($lines);

$a = 0;
for ($y = 0; $y < sizeOf($lines); $y++){
    for ($x = 0; $x < sizeOf($lines[$y]); $x++){
        if ($prev[$x] != "S" && $prev[$x] != "|") continue;
        if ($lines[$y][$x] != "^"){
            $lines[$y][$x] = "|";
            continue;
        }

        $a++;
        $lines[$y][$x-1] = "|";
        $lines[$y][$x+1] = "|";
    } 
    $prev = $lines[$y];
}

foreach ($lines as $line){
    echo implode("", $line).PHP_EOL;
}

echo $a;
