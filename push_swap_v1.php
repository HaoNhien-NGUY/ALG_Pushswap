<?php

include_once('./operations.php');

array_shift($argv);
$la = $argv;
$lb = [];

//generate test array
function createRandomArray($start, $end) {
    $rand = range($start, $end);
    shuffle($rand);
    return $rand;
}
//array de test
// $la = createRandomArray(1,100);

$result = [];

while(count($la)) {
    $smallestKey = array_search(min($la), $la);
    $countLa = count($la);
    if($smallestKey > ($countLa / 2)) {
        for ($i=0; $i < $countLa - $smallestKey; $i++) { 
            rra($la, $lb);
            $result[] = "rra";
        }
        pb($la, $lb);
        $result[] = "pb";
    } else {
        for ($i=0; $i < $smallestKey; $i++) { 
            ra($la, $lb);
            $result[] = "ra";
        }
        pb($la, $lb);
        $result[] = "pb";
    }
}

while(count($lb)) {
    pa($la, $lb);
    $result[] = "pa";
}

// var_dump($la);
// var_dump($lb);
echo implode(" ", $result) . "\n";
// var_dump($result);