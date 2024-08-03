<?php

// Max element
class PriorityQueue
{
    public $size;
    public $heap;

    public function __construct() {
        $this->size = 0;
        $this->heap = [];
    }

    /*returns the parent of ith Node*/
    private function parent(int $i) {
        return (int)(($i - 1) / 2);
    }
        
    // Get the Left Child index for the given index 
    private function left(int $i) {
        return 2 * $i + 1;
    }
        
    // Get the Right Child index for the given index 
    private function right( int $i) {
        return 2 * $i + 2;
    }

    public function size(){
        if($this->size === 0) {
            echo "Priority Queue is empty\n";
            return null;
        }
        return $this->size;
    }

    public function peek(){
        if($this->size === 0) {
            echo "Priority Queue is empty\n";
            return null;
        }
        $firstEl = $this->heap[0];
        $this->size --;
        $this->heap[0] = $this->heap[$this->size];
        $this->heap[$this->size] = $firstEl;
        array_splice($this->heap,$this->size,$this->size);
        $this->maxHeapify(0);
        return $firstEl;
    }

    public function add($value){
        $this->heap[$this->size] = $value; /*Insert new element at end*/
        $k = $this->size; /*store the index ,for checking heap property*/
        $this->size++; /*Increase the size*/

        while($k!= 0 && $this->heap[$this->parent($k)] < $this->heap[$k]) {
            $temp = $this->heap[$this->parent($k)];
            $this->heap[$this->parent($k)] = $this->heap[$k];
            $this->heap[$k] = $temp;
            $k = $this->parent($k);
        }
        return $this->heap;
    }

    private function maxHeapify($index) {
        $left = $this->left($index);
        $right = $this->right($index);
        $largest = $index;

        if ($left < $this->size && $this->heap[$left] > $this->heap[$largest]) {
            $largest = $left;
        }

        if ($right < $this->size && $this->heap[$right] > $this->heap[$largest]) {
            $largest = $right;
        }

        if ($largest != $index) {
            $temp = $this->heap[$index];
            $this->heap[$index] = $this->heap[$largest];
            $this->heap[$largest] = $temp;
            $this->maxHeapify($largest);
        }
    }

    public function remove(){
        if($this->size == 0){
            echo "Priority Queue is empty\n";
            return null;
        }
        $root = $this->heap[0];
        $last = $this->heap[$this->size - 1];
        $this->size--;
        $this->heap[0] = $last;
        $lastIndex = $this->size;
        array_splice($this->heap,$lastIndex,$lastIndex);
        $this->maxHeapify(0);

        return $root;
    }
}

$priorityQueue = new PriorityQueue();

$priorityQueue->add(10);
$priorityQueue->add(20);
$priorityQueue->add(30);
$priorityQueue->add(40);
$priorityQueue->add(50);
//cho "Priority Queue: " . $priorityQueue->remove(40);
//echo "Priority Queue: " . $priorityQueue->remove(20);
echo "Peek:" . $priorityQueue->peek();