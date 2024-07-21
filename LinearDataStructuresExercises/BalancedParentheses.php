<?php 

class Stack {
    private $stack;
    private $size;
    private $arr;

    public function __construct() {
        $this->stack = array();
        $this->size = 0;
    }

    public function push($element) {
        $this->stack[$this->size++] = $element;
    }

    public function pop() {
        if ($this->isEmpty()) {
            return "Стекът е празен";
        }
        return $this->stack[--$this->size];
    }

    public function peek() {
        if ($this->isEmpty()) {
            return "Стекът е празен";
        }
        return $this->stack[$this->size - 1];
    }

    public function isEmpty() {
        return $this->size == 0;
    }

    public function display() {
        for ($i = $this->size - 1; $i >= 0; $i--) {
            echo $this->stack[$i] . " ";
        }
        echo "\n";
    }

    public function solve($expr){

        for ($i=0; $i < strlen($expr); $i++) { 
            $x = $expr[$i]; 
            if ($x == '(' || $x == '[' || $x == '{') {
                $this->push($x);
                continue;
            }

            if($this->stack === 0) {
                return false;
            }
            
            $check = null;

            switch ($x) {
                case ')':
                    $check = $this->pop();
                    if ($check == '{' || $check == '[') {
                        return false;
                    }
                    break;
                case '}':
                    $check = $this->pop();
                    if ($check == '(' || $check == '[') {
                        return false;
                    }
                    break;
                case ']':
                    $check = $this->pop();
                    if ($check == '(' || $check == '{') {
                        return false;
                    }
                    break;
            }
        }
        return true;
    }
}

$stack = new Stack();
// echo $stack->solve('{[()]}');
echo $stack->solve('{[(]]}');
//{[()]} - This is a balanced parenthesis.

//{[(]]}- This is not a balanced parenthesis.