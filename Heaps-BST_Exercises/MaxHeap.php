<?php

class MaxHeap
{
    public $size;
    public $heap;

    public function __construct() {
        $this->size = 0;
        $this->heap = [];
    }

    /*returns the parent of ith Node*/
    public function parent(int $i) {
        return (int)(($i - 1) / 2);
    }
    
    // Get the Left Child index for the given index 
    public function left(int $i) {
        return 2 * $i + 1;
    }
    
    // Get the Right Child index for the given index 
    public function right( int $i) {
        return 2 * $i + 2;
    }

    public function heapifyUp($index) {
        $parent = $this->parent($index);

        while ($index != 0 && $this->heap[$parent] < $this->heap[$index]) {
            $temp = $this->heap[$parent];
            $this->heap[$parent] = $this->heap[$index];
            $this->heap[$index] = $temp;

            $index = $parent;
            $parent = $this->parent($index);
        }
    }
    
    public function insert($x){
        $this->heap[$this->size] = $x; /*Insert new element at end*/
        $k = $this->size; /*store the index ,for checking heap property*/
        $this->size++; /*Increase the size*/

        $this->heapifyUp($k);
        return $this->heap;
    }

    public function peek() {
        if(count($this->heap) < 0) {
            return -1;
        }
        return $this->heap[0];
    }
}

$maxHeap = new MaxHeap();
$maxHeap->insert(3);
$maxHeap->insert(10);
$maxHeap->insert(20);
$maxHeap->insert(5);
$maxHeap->insert(15);
$maxHeap->insert(25);
$maxHeap->insert(30);