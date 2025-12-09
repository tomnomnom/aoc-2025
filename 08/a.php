<?php
// lol
// I was so tired when I did this.
// I think that was probably a mistake.
class Box {
    public $x;
    public $y;
    public $z;
    public $c = 0;

    public function __construct($x, $y, $z){
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function id(){
        return sprintf("%d-%d-%d", $this->x, $this->y, $this->z);
    }

    public function distance(Box $b){
        return sqrt(
            pow($this->x - $b->x, 2) +
            pow($this->y - $b->y, 2) +
            pow($this->z - $b->z, 2)
        );
    }
}

function makeKey(Box $a, Box $b){
    $a = $a->id();
    $b = $b->id();
    if (($a <=> $b) < 0) return "{$a}|{$b}";
    return "{$b}|{$a}";
}

$lines = array_map(function($row){
    list($x, $y, $z) = explode(",", trim($row));
    return new Box($x, $y, $z);
}, file("input"));

$boxes = [];
foreach ($lines as $b){
    $boxes[$b->id()] = $b;
}

$distances = [];

foreach ($boxes as $a){
    foreach ($boxes as $b){
        if ($a->id() == $b->id()) continue;
        $key = makeKey($a, $b);
        if (isset($distances[$key])) continue;
        $distances[$key] = $a->distance($b);
    }
}

asort($distances);
echo sizeOf($distances).PHP_EOL;

//var_dump($distances);

$circuits = [];
$c = 1;
$limit = 1000;
foreach ($distances as $keys => $distance){
    if ($limit == 0) break;
    $limit--;

    list($a, $b) = explode("|", $keys);
    $a = $boxes[$a];
    $b = $boxes[$b];

    // new circuit
    if ($a->c == 0 && $b->c == 0){
        $a->c = $c;
        $b->c = $c;
        $circuits[$c] = [$a, $b];
        $c++;
        continue;
    }

    // a joins b
    if ($a->c == 0 && $b->c != 0){
        $a->c = $b->c;
        $circuits[$b->c][] = $a;
        continue;
    }

    // b joins a
    if ($a->c != 0 && $b->c == 0){
        $b->c = $a->c;
        $circuits[$a->c][] = $b;
        continue;
    }

    // both are in circuits
    if ($a->c != 0 && $b->c != 0){
        $cA = $circuits[$a->c];
        $cB = $circuits[$b->c];

        unset($circuits[$a->c]);
        unset($circuits[$b->c]);

        $circuits[$c] = array_merge($cA, $cB);
        foreach ($circuits[$c] as $box){
            $box->c = $c;
        }
        $c++;
        continue;
    }

    // try again
    if ($a->c == $b->c){
        $limit++;
    }
}

$circuits = [];
foreach ($boxes as $box){
    if (!isset($circuits[$box->c])){
        $circuits[$box->c] = [];
    }
    $circuits[$box->c][] = $box;
}

$loners = sizeOf($circuits[0]);
unset($circuits[0]);

$sizes = array_map("sizeOf", $circuits);
rsort($sizes);

//var_dump($distances);
//var_dump($circuits);

echo $sizes[0] * $sizes[1] * $sizes[2] . PHP_EOL;

//echo sizeOf($circuits) + $loners;

