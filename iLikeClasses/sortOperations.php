<?php

abstract class Pushswap {

    protected $la = [];
    protected $lb = [];
    protected $res = [];
    
    function __construct($list)
    {
        $this->la = $list;
    }

    abstract public function sort();

    protected function sa($print = true) {
        if(count($this->la) < 2) return;
        $tmp = $this->la[0];
        $this->la[0] = $this->la[1];
        $this->la[1] = $tmp;

        if($print) $this->res[] = "sa";
    }
    
    protected function sb($print = true) {
        if(count($this->lb) < 2) return;
        $tmp = $this->lb[0];
        $this->lb[0] = $this->lb[1];
        $this->lb[1] = $tmp;

        if($print) $this->res[] = "sb";
    }

    protected function sc() {
        $this->sa(false);
        $this->sb(false);

        $this->res[] = "sc";
    }

    protected function pa() {
        if(count($this->lb) == 0) return;
        array_unshift($this->la, array_shift($this->lb));

        $this->res[] = "pa";
    }

    protected function pb() {
        if(count($this->la) == 0) return;
        array_unshift($this->lb, array_shift($this->la));

        $this->res[] = "pb";
    }

    protected function ra($print = true) {
        if(count($this->la) < 2) return;
        array_push($this->la, array_shift($this->la));

        if($print) $this->res[] = "ra";
    }

    protected function rb($print = true) {
        if(count($this->lb) < 2) return;
        array_push($this->lb, array_shift($this->lb));

        if($print) $this->res[] = "rb";
    }

    protected function rr() {
        $this->ra(false);
        $this->rb(false);

        $this->res[] = "rr";
    }

    protected function rra($print = true) {
        if(count($this->la) < 2) return;
        array_unshift($this->la, array_pop($this->la));

        if($print) $this->res[] = "rra";
    }

    protected function rrb($print = true) {
        if(count($this->lb) < 2) return;
        array_unshift($this->lb, array_pop($this->lb));

        if($print) $this->res[] = "rrb";
    }

    protected function rrr() {
        $this->rra(false);
        $this->rrb(false);

        $this->res[] = "rrr";
    }
}