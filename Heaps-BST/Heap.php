<?php

// class Node{
//     public $data;
//     public $left;
//     public $right;

//     public function __construct($data){
//         $this->data = $data;
//         $this->left = null;
//         $this->right = null;
//     }
// }

class BinaryHeap {
    public $heap;
    public $size;
    public $capacity;

    public function __construct($cap){
        $this->heap = [];
        $this->capacity = $cap;
        $this->size = 0;
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

     /*Fix the min heap property*/
    public function insertMin($x){
        $this->heap[$this->size] = $x; /*Insert new element at end*/
        $k = $this->size; /*store the index ,for checking heap property*/
        $this->size++; /*Increase the size*/
        
        while($k != 0 && $this->heap[$this->parent($k)] > $this->heap[$k]) {
            $temp = $this->heap[$this->parent($k)];
            $this->heap[$this->parent($k)] = $this->heap[$k];
            $this->heap[$k] = $temp;
            $k = $this->parent($k);
        }
    }

    // Fix the max heap property
    public function insertMax($x){
        $this->heap[$this->size] = $x; /*Insert new element at end*/
        $k = $this->size; /*store the index ,for checking heap property*/
        $this->size++; /*Increase the size*/
        
        while($k!= 0 && $this->heap[$this->parent($k)] < $this->heap[$k]) {
            $temp = $this->heap[$this->parent($k)];
            $this->heap[$this->parent($k)] = $this->heap[$k];
            $this->heap[$k] = $temp;
            $k = $this->parent($k);
        }
    }

    // It depends from the heap we take the min or max value
    public function getMin(){
        return $this->heap[0];
    }

    // It depends from the heap we take the min or max value
    public function getMax(){
        return $this->heap[0];
    }

    public function minHeapify($index) {
        $left = $this->left($index);
        $right = $this->right($index);
        $smallest = $index;

        if ($left < $this->size && $this->heap[$left] < $this->heap[$smallest]) {
            $smallest = $left;
        }
        if ($right < $this->size && $this->heap[$right] < $this->heap[$smallest]) {
            $smallest = $right;
        }
        if ($smallest != $index) {
            $temp = $this->heap[$index];
            $this->heap[$index] = $this->heap[$smallest];
            $this->heap[$smallest] = $temp;
            $this->minHeapify($smallest);
        }
    }

    public function maxHeapify($index) {
        $left = $this->left($index);
        $right = $this->right($index);
        $largest = $index;
     
        if($left < $this->size && $this->heap[$left] > $this->heap[$largest]) {
            $largest = $left;
        }
        if($right < $this->size && $this->heap[$right] > $this->heap[$largest]) {
            $largest = $right;
        }

        if($largest != $index) {
            $temp = $this->heap[$index];
            $this->heap[$index] = $this->heap[$largest];
            $this->heap[$largest] = $temp;
            $this->maxHeapify($largest);
        }
    }

    public function buildMiniHeap() {
        for ($i = (int)(($this->size - 2) / 2); $i >= 0; $i--) {
            $this->minHeapify($i);
        }
    }

    public function buildMaxHeap() {
        for ($i = (int)(($this->size - 2) / 2); $i >= 0; $i--) {
            $this->maxHeapify($i);
        }
    }

    public function decreaseKey($i,$val) {
        $this->heap[$i] = $val;
        while($i!= 0 && $this->heap[$this->parent($i)] > $this->heap[$i]) {
            $temp = $this->heap[$this->parent($i)];
            $this->heap[$this->parent($i)] = $this->heap[$i];
            $this->heap[$i] = $temp;
            $i = $this->parent($i);
        }
    }
    
    public function extractMin(){
        if($this->size <= 0) {
            return PHP_INT_MAX;
        } if($this->size == 1) {
            $this->size--;
            return $this->heap[0];
        }
        $mini = $this->heap[0];
        $this->heap[0] = $this->heap[$this->size - 1]; /*Copy last Node value to root Node value*/
        $this->heap[$this->size - 1] = $mini;
        $this->size--;
        $this->minHeapify(0); /*Call minHeapify on root node*/
        return $mini;
    }

    // Function to delete the root from Heap
    public function delete($i) {
        //get the last element
        $lastElement = $this->heap[$this->size - 1];
        
        // replace root with first element
        $this->heap[0] = $lastElement;
        
        // decrease size
        $this->size--;

        // Call min heapify
        $this->minHeapify(0);

        return $this->size;
    }
}

$binaryHeap = new BinaryHeap(20);
// $binaryHeap->insert(4);
$binaryHeap->insertMin(1);
$binaryHeap->insertMin(2);
$binaryHeap->insertMin(6);
$binaryHeap->insertMin(7);
$binaryHeap->insertMin(3);
$binaryHeap->insertMin(8);
$binaryHeap->insertMin(5);
$binaryHeap->insertMin(-1);
$binaryHeap->insertMin(100);
$binaryHeap->insertMin(31);
$binaryHeap->insertMin(16);
$binaryHeap->insertMin(51);
$binaryHeap->insertMin(41);
$binaryHeap->insertMin(13);
$binaryHeap->insertMin(-2);
$binaryHeap->insertMin(-3);
//13, 16, 31, 41, 51, 100
$binaryHeap->Decreasekey(3, -2);
// $binaryHeap->buildMiniHeap();
$binaryHeap->buildMaxHeap();
$binaryHeap->insertMax(500);
// $binaryHeap->extractMin();
$binaryHeap->delete(0);