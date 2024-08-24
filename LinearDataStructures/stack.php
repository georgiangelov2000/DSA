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
        $element = $this->stack[$this->size - 1];
        $this->stack = array_slice($this->stack, 0 ,--$this->size);
        return $element;
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

    public function search($element) {
        for ($i = $this->size - 1; $i >= 0; $i--) {
            if ($this->stack[$i] == $element) {
                return $this->size - $i - 1; // Връща разстоянието от върха на стека
            }
        }
        return -1; // Елементът не е намерен
    }

    public function access($index) {
        if ($index < 0 || $index >= $this->size) {
            return "Невалиден индекс";
        }
        return $this->stack[$this->size - $index - 1];
    }
}

$stack = new Stack();

$stack->push(1);
$stack->push(2);
$stack->push(3);

echo "Елементите в стека: ";
$stack->display();
echo "Намерен елемент: " . $stack->search(1);
echo "Върхът на стека е: " . $stack->peek() . "\n";

echo "Изваден елемент: " . $stack->pop() . "\n";
echo "Изваден елемент: " . $stack->pop() . "\n";

echo "Елементите в стека след изваждане: ";
$stack->display();
echo "Елементът на позиция 0 от върха на стека е: " . $stack->access(0) . "\n";