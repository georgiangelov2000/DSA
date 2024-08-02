<?php
// Priority queue with max heap
class MaxHeap
{
    private $heap;
    private $size;
    private $count;
    private $initial_size;

    public function __construct($initial_size = 4) {
        $this->initial_size = $initial_size;
        $this->count = 0;
        $this->size = $initial_size;
        $this->heap = array_fill(0, $this->size, 0);
    }

    public function insert($value) {
        if ($this->count == $this->size) {
            $this->size += 1;
            $this->heap = array_merge($this->heap, array_fill(0, 1, 0));
        }

        $index = $this->count++;
        while ($index > 0) {
            $parent = (int)(($index - 1) / 2);
            if ($this->heap[$parent] >= $value) break;
            $this->heap[$index] = $this->heap[$parent];
            $index = $parent;
        }
        $this->heap[$index] = $value;
    }

    private function maxHeapify($index) {
        $left = 2 * $index + 1;
        $right = $left + 1;
        $largest = $index;

        if ($left < $this->count && $this->heap[$left] > $this->heap[$largest]) {
            $largest = $left;
        }

        if ($right < $this->count && $this->heap[$right] > $this->heap[$largest]) {
            $largest = $right;
        }

        if ($largest != $index) {
            $temp = $this->heap[$index];
            $this->heap[$index] = $this->heap[$largest];
            $this->heap[$largest] = $temp;
            $this->maxHeapify($largest);
        }
    }

    public function extractMax() {
        if ($this->count == 0) {
            throw new UnderflowException("Heap is empty");
        }

        $removed = $this->heap[0];
        $temp = $this->heap[--$this->count];

        if ($this->count <= ($this->size - 2) && $this->size > $this->initial_size) {
            $this->size -= 1;
            $this->heap = array_slice($this->heap, 0, $this->size);
        }

        $this->heap[0] = $temp;
        $this->maxHeapify(0);

        return $removed;
    }

    public function display() {
        for ($i = 0; $i < $this->count; ++$i) {
            echo "|" . $this->heap[$i] . "|";
        }
        echo "\n";
    }

    public function emptyPQ() {
        while ($this->count != 0) {
            echo "<<" . $this->extractMax();
        }
        echo "\n";
    }

}

$heap = new MaxHeap();
$heap->insert(1);
$heap->insert(5);
$heap->insert(3);
$heap->insert(7);
$heap->insert(9);
$heap->insert(8);
$heap->extractMax();