<?php

class ReversedList {
    public $array;
    public $size;
    public $capacity;
    public $indexMap;
    
    public function __construct($initialCapacity = 4) {
        $this->array = array_fill(0, $initialCapacity, null);
        $this->size = 0;
        $this->capacity = $initialCapacity;
        $this->indexMap = [];
    }

    public function insert($element) {
        if ($this->size == $this->capacity) {
            $this->resize();
        }
        $this->array[$this->size++] = $element;
    }

    public function removeAt($index) {
        if ($index < 0 || $index >= $this->size) {
            return "Index out of range";
        }
        
        for ($i = $this->size - 1 - $index; $i < $this->size - 1; $i++) {
            $this->array[$i] = $this->array[$i + 1];
        }
        $this->size--;
        $this->array[$this->size] = null;
    }

    private function resize() {
        $this->capacity *= 2;
        $newArray = array_fill(0, $this->capacity, null);
        for ($i = 0; $i < $this->size; $i++) {
            $newArray[$i] = $this->array[$i];
        }
        $this->array = $newArray;
    }

    public function get($index) {
        if ($index < 0 || $index >= $this->size) {
            return ("Index out of range");
        }
        return $this->array[$this->size - 1 - $index];
    }

    public function set($index, $value) {
        if ($index < 0 || $index >= $this->size) {
            return "Index out of range";
        }
        $this->array[$this->size - 1 - $index] = $value;
    }

    public function capacity(): int {
        return count($this->array);
    }

    public function count(): int {
        return $this->size;
    }
}

$list = new ReversedList();
for ($i=1; $i <= 10 ; $i++) { 
    $list->insert($i);
}

echo "Count: " . $list->count() . PHP_EOL;
echo "Capacity: " . $list->capacity() . PHP_EOL;

foreach ($list->array as $item) {
    echo $item . PHP_EOL;
}

$list->removeAt(4);
echo "After removing at index 1:" . PHP_EOL;
foreach ($list->array as $item) {
    echo $item . PHP_EOL;
}

echo "Item at index 0: " . $list->get(0) . PHP_EOL;
$list->set(0, 11);
echo "After setting index 0 to 1: " . PHP_EOL;
foreach ($list->array as $item) {
    echo $item . PHP_EOL;
}