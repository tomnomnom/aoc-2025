<?php

$ls = array_map(
    fn($l) => str_split(rtrim($l, "\n\r")),
    file("input")
);

$ops = array_pop($ls); 

$cols = 0;
foreach ($ls as $l){
    if (sizeOf($l) > $cols){
        $cols = sizeOf($l);
    }
}

class Eq {
    public $nums = [];
    public $op = "";
}

$eqs = [];
$eq = new Eq();
for ($i = 0; $i <= $cols; $i++){
    $num = "";
    for ($j = 0; $j < sizeOf($ls); $j++){
        if (isset($ls[$j][$i]) && $ls[$j][$i] != " ") {
            $num .= $ls[$j][$i];
        }
    }

    if (trim($num) == ""){
        $eqs[] = $eq;
        $eq = new Eq();
        continue;
    }

    if (isset($ops[$i]) && $ops[$i] != " "){
        $eq->op = $ops[$i];
    }

    $eq->nums[] = intval(trim($num));
}


$total = 0;
foreach ($eqs as $eq){
    $a = array_shift($eq->nums);
    foreach ($eq->nums as $num){
        if ($eq->op == "+"){
            $a += $num;
        } else {
            $a *= $num;
        }
    }
    $total += $a;
}

echo $total.PHP_EOL;
