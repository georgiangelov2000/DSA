<?php
class Stack
{
    public $stack;
    public $size;
    public $removedElements = [];
    public function __construct()
    {
        $this->stack = array();
        $this->size = 0;
        $this->removedElements = [];
    }

    public function push($element)
    {
        if($element === "UNDO") {
            return $this->pop();
        } elseif($element === "REDO") {
            return $this->redo();
        } elseif($element === "READ") {
            return $this->read();
        } else {
            $this->stack[] = $element;
            $this->size++;
        }
        var_dump($this->stack);
    }

    public function redo()
    {
        if (empty($this->removedElements)) {
            return "Няма нищо за възстановяване";
        }

        $element = array_pop($this->removedElements);
        $this->stack[] = $element;
        $this->size++;
    }

    public function pop()
    {
        if ($this->isEmpty()) {
            return "Стекът е празен";
        }

        $element = array_pop($this->stack);
        $this->size--;
        $this->removedElements[] = $element;
        return $element;
    }

    public function peek() {
        if ($this->isEmpty()) {
            return "Стекът е празен";
        }
        return $this->stack[$this->size - 1];
    }

    public function isEmpty() {
        return $this->size === 0;
    }
    public function read(){
        return $this->stack;
    }
}

$stack = new Stack();
$arr = ["WRITE A", "WRITE B", "WRITE C", "UNDO", "READ", "REDO", "READ"];
foreach ($arr as $key => $value) {
    $stack->push($value);
}