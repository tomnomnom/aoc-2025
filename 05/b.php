<?php

$lines = array_map("trim", file("input"));

$ranges = [];
while($line = trim(array_shift($lines))){
    $ranges[] = array_map("intval", explode("-", $line));
}

usort($ranges, function($a, $b){
    return $a[0] <=> $b[0];
});

$a = 0;
$cur = array_shift($ranges);
do {
    $next = array_shift($ranges);
    
    if ($next && $next[0] <= $cur[1]){
        if ($next[1] > $cur[1]){
            $cur[1] = $next[1];
        }
        continue;
    }

    $a += $cur[1] - $cur[0] + 1;
    $cur = $next;

} while($next);

echo $a.PHP_EOL;
