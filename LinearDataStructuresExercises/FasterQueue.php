<?php
class Node {
    public $data;
    public $next;
    public $prev;

    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
        $this->prev = null;
    }
}

class Queue {
    public $head;
    public $last;

    public function __construct() {
        $this->head = null;
        $this->last = null;
    }

    public function enqueue($element) {
        $newNode = new Node($element);
        if($this->last === null) {
            $this->head = $newNode;
            $this->last = $newNode;
        } else {
            $this->last->next = $newNode;
            $this->last = $newNode;
        }
        return $this->last->data;
    }

    public function dequeue() {
        $oldHead = $this->head;
        if($this->head === null) {
            $this->last = null;
        } else {
            $this->head = $oldHead->next;
        }
        return $oldHead->data;
    }
}

$queue = new Queue();
echo "Add element in enqueue:" . $queue->enqueue(1) . "\n";
echo "Add element in enqueue:" . $queue->enqueue(2) . "\n";
echo "Add element in enqueue:" . $queue->enqueue(3) . "\n";
echo "Add element in enqueue:" . $queue->enqueue(4) . "\n";

$currentNode = $queue->head;
while($currentNode !== null) {
    echo $currentNode->data;
    $currentNode = $currentNode->next;
}