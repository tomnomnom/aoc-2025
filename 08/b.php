<?php
// This place is a message... and part of a system of messages... pay attention to it!
// Sending this message was important to us. We considered ourselves to be a powerful culture.
// This place is not a place of honor... no highly esteemed deed is commemorated here... nothing valued is here.
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
$circuitCount = sizeOf($boxes);

foreach ($distances as $keys => $distance){

    if ($circuitCount == 1){
        break;
    }

    list($a, $b) = explode("|", $keys);
    $a = $boxes[$a];
    $b = $boxes[$b];

    // new circuit
    if ($a->c == 0 && $b->c == 0){
        $a->c = $c;
        $b->c = $c;
        $circuits[$c] = [$a, $b];
        $c++;
        $circuitCount--;
        continue;
    }

    // a joins b
    if ($a->c == 0 && $b->c != 0){
        $a->c = $b->c;
        $circuits[$b->c][] = $a;
        $circuitCount--;
        continue;
    }

    // b joins a
    if ($a->c != 0 && $b->c == 0){
        $b->c = $a->c;
        $circuits[$a->c][] = $b;
        $circuitCount--;
        continue;
    }

    if ($a->c == $b->c) continue;

    // both are in circuits
    if ($a->c != 0 && $b->c != 0){
        
        $r = $b->c;
        foreach ($circuits[$r] as $box){
            $box->c = $a->c;
            $circuits[$a->c][] = $box;
        }
        unset($circuits[$r]);
        $circuitCount--;
    }
}

echo $a->x * $b->x.PHP_EOL;

