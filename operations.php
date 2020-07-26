<?php

// ========== mes fonctions ========== //

function findLowerClosestKey($search , $arr) {
    $copy = $arr;
    sort($copy);
    if(count($arr) <= 1) return 0;

    foreach ($copy as $key => $value) {
        if($key == 0) continue;

        if($search >= $copy[$key-1] && $search < $value) {
            return array_search($copy[$key-1], $arr);
        }
    }
    return array_search(max($arr), $arr);
}

//generate test array
function createRandomArray($start, $end) {
    $rand = range($start, $end);
    shuffle($rand);
    return $rand;
}

// ========== operations ========== //

//echanges la pos des 2 premiers elements de LA
function sa(&$la, &$lb) {
    if(count($la) < 2) return;
    $tmp = $la[0];
    $la[0] = $la[1];
    $la[1] = $tmp;
}

//echange la pos des 2 premiers elements de LB
function sb(&$la, &$lb) {
    if(count($lb) < 2) return;
    $tmp = $lb[0];
    $lb[0] = $lb[1];
    $lb[1] = $tmp;
}

//sa et sb en meme temps
function sc(&$la, &$lb) {
    sa($la, $lb);
    sb($la, $lb);
}

//prends le 1er element de LB et le place en 1er pos de LA
function pa(&$la, &$lb) {
    if(count($lb) == 0) return;
    array_unshift($la, array_shift($lb));
}

//prends le 1er element de LA et le place en 1er pos de LB
function pb(&$la, &$lb) {
    if(count($la) == 0) return;
    array_unshift($lb, array_shift($la));
}

//rotation de LA vers le debut, 1er element devient le dernier
function ra(&$la, &$lb) {
    if(count($la) < 2) return;
    array_push($la, array_shift($la));
}

//rotation de LB vers le debut, 1er element devient le dernier
function rb(&$la, &$lb) {
    if(count($lb) < 2) return;
    array_push($lb, array_shift($lb));
}

//ra et rb en meme temps
function rr(&$la, &$lb) {
    ra($la, $lb);
    rb($la, $lb);
}

//rotation de LA vers la finm dernier element devient premier
function rra(&$la, &$lb) {
    if(count($la) < 2) return;
    array_unshift($la, array_pop($la));
}

//rotation de LB vers la finm dernier element devient premier
function rrb(&$la, &$lb) {
    if(count($lb) < 2) return;
    array_unshift($lb, array_pop($lb));
}

//rra et rrb en meme temps
function rrr(&$la, &$lb) {
    rra($la, $lb);
    rrb($la, $lb);
}