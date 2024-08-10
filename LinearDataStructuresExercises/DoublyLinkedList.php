<?php

class Node {
    public $data;
    public $next;
    public $prev;
    public $size;

    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
        $this->prev = null;
    }
}

class DoublyLinkedList {
    public $head;
    public $last;
    public $size;

    public function __construct() {
        $this->size = 0;
    }

    public function addFirst($el){
        $newNode = new Node($el);
        if($this->head === null){
            $this->head = $newNode;
            $this->last = $newNode;
        } else {
            $newNode->next = $this->head;
            $this->head->prev = $newNode;
            $this->head = $newNode;
        }
        $this->size++;
        return $this->head->data;
    }
    public function addLast($el){
        $newNode = new Node($el);
        if($this->last === null) {
            $this->last = $newNode;
            $this->head = $newNode;
        } else {
            $this->last->next = $newNode;
            $newNode->prev = $this->last;
            $this->last = $newNode;
        }
        $this->size++;
        return $this->last->data;
    }
    public function removeFirst(){
        $oldHead = $this->head;
        $this->head = $oldHead->next;
        if($this->head === null) {
            $this->last = null;
        }
        $this->size--;
        return $oldHead->data;
    }
    public function removeLast(){
        $lastHead = $this->last;
        $this->last = $lastHead->prev;
        if($this->last === null) {
            $this->head = null;
        } else {
            $this->last->next = null;
        }
        $this->size--;
        return $this->last->data;
    }
    public function getFirst(){
        return $this->head->data;
    }
    public function getLast(){
        return $this->last->data;
    }
    public function getCount(){
        return $this->size;
    }
    public function attachBefore($beforeValue, $element){
        $newNode = new Node($element);
        $currentNode = $this->head;
        while($currentNode->data!= $beforeValue && $currentNode!== null) {
            $currentNode = $currentNode->next;
        }
        if($currentNode === null) {
            echo "Element not found in Doubly Linked List";
            return;
        }
        if($currentNode->prev === null) {
            $this->head = $newNode;
            $newNode->next = $currentNode;
            $currentNode->prev = $newNode;
        } else {
            $newNode->next = $currentNode;
            $newNode->prev = $currentNode->prev;
            $currentNode->prev->next = $newNode;
            $currentNode->prev = $newNode;
        }
        $this->size++;
    }
    public function getElement($value) {
        $currentNode = $this->head;
        echo '$currentNode->data =>'. $currentNode->data;
        echo "\n";
        echo $currentNode->data != $value;
        echo "\n";
        while($currentNode->data != $value && $currentNode!== null) {
            $currentNode = $currentNode->next;
        }
        echo $currentNode->data;
        if($currentNode === null) {
            echo "Element not found in Doubly Linked List";
            return null;
        }
        return $currentNode->data;
    }
    public function deleteElement($value){
        $currentNode = $this->head;
        while($currentNode->data!= $value && $currentNode!== null) {
            $currentNode = $currentNode->next;
        }
        if($currentNode === null) {
            echo "Element not found in Doubly Linked List";
            return;
        }
        if($currentNode->prev === null) {
            $this->head = $currentNode->next;
        } else {
            $currentNode->prev->next = $currentNode->next;
        }
        if($currentNode->next === null) {
            $this->last = $currentNode->prev;
        } else {
            $currentNode->next->prev = $currentNode->prev;
        }
        $this->size--;
    }
    public function setValue($oldValue, $newValue) {
        $currentNode = $this->head;
        while($currentNode->data!= $oldValue && $currentNode!== null) {
            $currentNode = $currentNode->next;
        }
        if($currentNode === null) {
            echo "Element not found in Doubly Linked List";
            return;
        }
        $currentNode->data = $newValue;
    }
    
}

$dll = new DoublyLinkedList();
echo "Add element to Doubly Linked List:" . $dll->addFirst(1) . "\n";
echo "Add element to Doubly Linked List:" . $dll->addFirst(2) . "\n";
echo "Add element to Doubly Linked List:" . $dll->addFirst(3) . "\n";
echo "Add element to Doubly Linked List:" . $dll->addLast(4) . "\n";
echo "Doubly Linked List size:" . $dll->getCount() . "\n";
echo "Get First:" . $dll->getFirst() . "\n";
echo "Get Last:" . $dll->getLast() . "\n";
// $dll->attachBefore(4,7);
// $dll->removeFirst(4);
// $dll->removeLast(4);
// $dll->getElement(2);
$dll->deleteElement(4);
$currentNode = $dll->head;
while($currentNode !== null) {
    echo $currentNode->data;
    $currentNode = $currentNode->next;
}