<?php

class Node
{
    public $data;
    public $next;
    
    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
    }
}


class Queue
{
    public $head;
    public $tail;

    public function __construct() {
        $this->head = null;
        $this->tail = null;
    }
    // Time complexity O(1)
    public function enqueue($element) {
        $newNode = new Node($element);

        if($this->tail === null) {
            $this->head = $newNode;
            $this->tail = $newNode;
            return;
        }

        $this->tail->next = $newNode;
        $this->tail = $newNode;
    }
    // Time complexity O(1)
    public function dequeue(){
        if($this->head === null) {
            return null;
        }

        $dequeuedNode = $this->head;
        $this->head = $this->head->next;

        if($this->head === null) {
            $this->tail = null;
        }

        return $dequeuedNode->data;
    }
    // Time complexity O(1)
    public function getFront  () {
        if($this->head === null) {
            return null;
        }
        return $this->head->data;
    }
    // Time complexity O(1)
    public function getRear () {
        if($this->tail === null) {
            return null;
        }
        return $this->tail->data;
    }
}

$queue = new Queue();

$queue->enqueue(1);
$queue->enqueue(2);
$queue->enqueue(3);
$queue->enqueue(4);
echo $queue->dequeue();