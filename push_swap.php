<?php

include_once('./operations.php');

array_shift($argv);
$la = $argv;
$lb = [];

$result = [];

//array de test
// $la = createRandomArray(1, 999);
// $la = array_slice($la, 0, 100);
// var_dump($la);

$laCopyOne = $la;
sort($laCopyOne);

if ($la == $laCopyOne) {
    echo "\n";
    exit();
}
if (count($la) == 2) {
    if (array_search(min($la), $la) == 1) {
        sa($la, $lb);
        $result[] = "sa";
    }
    echo implode(" ", $result) . "\n";
    exit();
}

while (count($la) - 3) {
    $laLength = count($la);
    $searchRange = ceil($laLength / 10) >= 3 ? ceil($laLength / 10) : 3;
    $laStart = array_slice($la, 0, $searchRange, true);
    $laEnd = array_slice($la, $laLength - $searchRange, null, true);
    $minStart = min($laStart);
    $minEnd = min($laEnd);
    $minStartKey = array_search($minStart, $laStart);
    $minEndKey = $laLength - array_search($minEnd, $laEnd);

    if ($minStart < $minEnd) {
        $lbKey = findLowerClosestKey($minStart, $lb);

        if ($lbKey <= $minStartKey) {
            for ($i = 0; $i < $lbKey; $i++) {
                rr($la, $lb);
                $result[] = "rr";
            }
            for ($i = 0; $i < $minStartKey - $lbKey; $i++) {
                ra($la, $lb);
                $result[] = "ra";
            }
        } else if ($lbKey < count($lb) / 2) {
            for ($i = 0; $i < $minStartKey; $i++) {
                rr($la, $lb);
                $result[] = "rr";
            }
            for ($i = 0; $i < $lbKey - $minStartKey; $i++) {
                rb($la, $lb);
                $result[] = "rb";
            }
        } else {
            $lbLength = count($lb);
            for ($i = 0; $i < $lbLength - $lbKey; $i++) {
                rrb($la, $lb);
                $result[] = "rrb";
            }
            for ($i = 0; $i < $minStartKey; $i++) {
                ra($la, $lb);
                $result[] = "ra";
            }
        }
    } else {
        $lbKeyR = findLowerClosestKey($minEnd, $lb);
        $lbKey = count($lb) - $lbKeyR;

        if ($lbKey <= $minEndKey) {
            for ($i = 0; $i < $lbKey; $i++) {
                rrr($la, $lb);
                $result[] = "rrr";
            }
            for ($i = 0; $i < $minEndKey - $lbKey; $i++) {
                rra($la, $lb);
                $result[] = "rra";
            }
        } else if ($lbKeyR > count($lb) / 2) {
            for ($i = 0; $i < $minEndKey; $i++) {
                rrr($la, $lb);
                $result[] = "rrr";
            }
            for ($i = 0; $i < $lbKey - $minEndKey; $i++) {
                rrb($la, $lb);
                $result[] = "rrb";
            }
        } else {
            for ($i = 0; $i < $lbKeyR; $i++) {
                rb($la, $lb);
                $result[] = "rb";
            }
            for ($i = 0; $i < $minEndKey; $i++) {
                rra($la, $lb);
                $result[] = "rra";
            }
        }
    }

    pb($la, $lb);
    $result[] = "pb";
}

$laCopy = $la;
sort($laCopy);
if ($la != $laCopy) {
    if (array_search(max($la), $la) == 2 && array_search(min($la), $la) == 1) {
        sa($la, $lb);
        $result[] = "sa";
    } else if (array_search(max($la), $la) == 0 && array_search(min($la), $la) == 1) {
        ra($la, $lb);
        $result[] = "ra";
    } else if (array_search(max($la), $la) == 0 && array_search(min($la), $la) == 2) {
        sa($la, $lb);
        $result[] = "sa";
        rra($la, $lb);
        $result[] = "rra";
    } else if (array_search(max($la), $la) == 1 && array_search(min($la), $la) == 0) {
        sa($la, $lb);
        $result[] = "sa";
        ra($la, $lb);
        $result[] = "ra";
    } else if (array_search(max($la), $la) == 1 && array_search(min($la), $la) == 2) {
        rra($la, $lb);
        $result[] = "rra";
    }
}

while (count($lb)) {
    pa($la, $lb);
    $result[] = "pa";
}

// var_dump($la);
// var_dump($lb);
// var_dump($result);

echo implode(" ", $result) . "\n";