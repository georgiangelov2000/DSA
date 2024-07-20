<?php

class Queue {
    private $queue;
    private $size;

    public function __construct() {
        $this->queue = array();
        $this->size = 0;
    }

    public function enqueue($element) {
        $this->queue[$this->size++] = $element;
    }

    public function dequeue() {
        if ($this->isEmpty()) {
            return "Опашката е празна";
        }
        $element = $this->queue[0];
        for ($i = 0; $i < $this->size - 1; $i++) {
            $this->queue[$i] = $this->queue[$i + 1];
        }
        unset($this->queue[--$this->size]);
        return $element;
    }

    public function peek() {
        if ($this->isEmpty()) {
            return "Опашката е празна";
        }
        return $this->queue[0];
    }

    public function isEmpty() {
        return $this->size == 0;
    }

    public function display() {
        for ($i = 0; $i < $this->size; $i++) {
            echo $this->queue[$i] . " ";
        }
        echo "\n";
    }
}

// Пример за използване
$queue = new Queue();

$queue->enqueue(1);
$queue->enqueue(2);
$queue->enqueue(3);

echo "Елементите в опашката: ";
$queue->display();

echo "Първият елемент е: " . $queue->peek() . "\n";

echo "Изваден елемент: " . $queue->dequeue() . "\n";
echo "Изваден елемент: " . $queue->dequeue() . "\n";

echo "Елементите в опашката след изваждане: ";
$queue->display();