<?php

class Stack {
    private $stack;
    private $size;

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
}

$stack = new Stack();

$stack->push(1);
$stack->push(2);
$stack->push(3);

echo "Елементите в стека: ";
$stack->display();

echo "Върхът на стека е: " . $stack->peek() . "\n";

echo "Изваден елемент: " . $stack->pop() . "\n";
echo "Изваден елемент: " . $stack->pop() . "\n";

echo "Елементите в стека след изваждане: ";
$stack->display();