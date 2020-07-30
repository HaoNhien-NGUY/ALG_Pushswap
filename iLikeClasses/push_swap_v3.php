<?php

include_once('./sortOperations.php');

class PushSwap extends SortOperations
{

    protected $la = [];
    protected $lb = [];
    protected $res = [];

    function __construct($list)
    {
        $this->la = $list;
    }

    public function mySort()
    {
        while (count($this->la) - 3) {
            $laLength = count($this->la);
            $searchRange = ceil($laLength / 10) >= 3 ? ceil($laLength / 10) : 3;
            $laStart = array_slice($this->la, 0, $searchRange, true);
            $laEnd = array_slice($this->la, $laLength - $searchRange, null, true);
            $minStart = min($laStart);
            $minEnd = min($laEnd);
            $minStartKey = array_search($minStart, $laStart);
            $minEndKey = $laLength - array_search($minEnd, $laEnd);
        
            if ($minStart < $minEnd) {
                $lbKey = $this->findLowerClosestKey($minStart, $this->lb);
        
                if ($lbKey <= $minStartKey) {
                    for ($i = 0; $i < $lbKey; $i++) {
                        $this->rr();
                    }
                    for ($i = 0; $i < $minStartKey - $lbKey; $i++) {
                        $this->ra();
                    }
                } else if ($lbKey < count($this->lb) / 2) {
                    for ($i = 0; $i < $minStartKey; $i++) {
                        $this->rr();
                    }
                    for ($i = 0; $i < $lbKey - $minStartKey; $i++) {
                        $this->rb();
                    }
                } else {
                    $lbLength = count($this->lb);
                    for ($i = 0; $i < $lbLength - $lbKey; $i++) {
                        $this->rrb();
                    }
                    for ($i = 0; $i < $minStartKey; $i++) {
                        $this->ra();
                    }
                }
            } else {
                $lbKeyR = $this->findLowerClosestKey($minEnd, $this->lb);
                $lbKey = count($this->lb) - $lbKeyR;
        
                if ($lbKey <= $minEndKey) {
                    for ($i = 0; $i < $lbKey; $i++) {
                        $this->rrr();
                    }
                    for ($i = 0; $i < $minEndKey - $lbKey; $i++) {
                        $this->rra();
                    }
                } else if ($lbKeyR > count($this->lb) / 2) {
                    for ($i = 0; $i < $minEndKey; $i++) {
                        $this->rrr();
                    }
                    for ($i = 0; $i < $lbKey - $minEndKey; $i++) {
                        $this->rrb();
                    }
                } else {
                    for ($i = 0; $i < $lbKeyR; $i++) {
                        $this->rb();
                    }
                    for ($i = 0; $i < $minEndKey; $i++) {
                        $this->rra();
                    }
                }
            }
        
            $this->pb();
        }

        if(count($this->la)) $this->threeNumberSort($this->la);

        $this->allLBtoLA();

        return $this->res;
    }

    protected function threeNumberSort(array $array)
    {
        $copy = $array;
        sort($copy);
        if ($array != $copy) {
            if (array_search(max($array), $array) == 2 && array_search(min($array), $array) == 1) {
                $this->sa();
            } else if (array_search(max($array), $array) == 0 && array_search(min($array), $array) == 1) {
                $this->ra();
            } else if (array_search(max($array), $array) == 0 && array_search(min($array), $array) == 2) {
                $this->sa();
                $this->rra();
            } else if (array_search(max($array), $array) == 1 && array_search(min($array), $array) == 0) {
                $this->sa();
                $this->ra();
            } else if (array_search(max($array), $array) == 1 && array_search(min($array), $array) == 2) {
                $this->rra();
            }
        }
    }

    protected function allLBtoLA() {
        while (count($this->lb)) {
            $this->pa();
        }
    }

    protected function findLowerClosestKey($search, $arr)
    {
        $copy = $arr;
        sort($copy);
        if (count($arr) <= 1) return 0;

        foreach ($copy as $key => $value) {
            if ($key == 0) continue;

            if ($search >= $copy[$key - 1] && $search < $value) {
                return array_search($copy[$key - 1], $arr);
            }
        }
        return array_search(max($arr), $arr);
    }
}

//create random array
function createRandomArray($start, $end) {
    $rand = range($start, $end);
    shuffle($rand);
    return $rand;
}

$min = 0;
$avg = [];

for($i = 0; $i < 1000; $i++) {
    $la = createRandomArray(1, 999);
    $la = array_slice($la, 0, 100);

    $push = new PushSwap($la);
    $resArray = $push->mySort();

    $avg[] = count($resArray);
    
    if($i == 0) {
        $min = count($resArray);
    } else if(count($resArray) < $min) {
        $min = count($resArray);
    }
}

$avg = array_sum($avg) / count($avg);

echo "Average : " . $avg . PHP_EOL;
echo "Minimum : " . $min . PHP_EOL;