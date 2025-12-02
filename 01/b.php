<?php

// This is the fun way, not the smart way (:
class Dial {
    public $pos = 50;
    public $c = 0;

    public function rightOne(){
        $this->pos += 1;
        if ($this->pos == 100){
            $this->c++;
            $this->pos = 0;
        }
    }

    public function leftOne(){
        $this->pos -= 1;
        if ($this->pos == 0){
            $this->c++;
        }
        if ($this->pos < 0){
            $this->pos = 99;
        }
    }

    public function left($n){
        for ($i = 0; $i < $n; $i++) $this->leftOne();
    }
    public function right($n){
        for ($i = 0; $i < $n; $i++) $this->rightOne();
    }
}

$rows = file("input");
//$rows = file("example");

$dial = new Dial();

foreach($rows as $row){
    $row = trim($row);
    $d = substr($row, 0, 1);
    $n = intval(substr($row, 1));

    switch ($d){
    case "L":
        $dial->left($n);
        break;
    case "R":
        $dial->right($n);
        break;
    }
}

echo $dial->c.PHP_EOL;
