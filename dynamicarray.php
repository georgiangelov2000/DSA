<?php
class DynamicArray {
    private $array;
    private $size;
    private $capacity;

    public function __construct($initialCapacity = 4) {
        $this->array = array_fill(0, $initialCapacity, null);
        $this->size = 0;
        $this->capacity = $initialCapacity;
    }

    public function insert($element) {
        if ($this->size == $this->capacity) {
            $this->resize();
        }
        $this->array[$this->size++] = $element;
    }

    private function resize() {
        $this->capacity *= 2;
        $newArray = array_fill(0, $this->capacity, null);
        for ($i = 0; $i < $this->size; $i++) {
            $newArray[$i] = $this->array[$i];
        }
        $this->array = $newArray;
    }

    public function getArray() {
        return array_slice($this->array, 0, $this->size);
    }
}

// Example usage
$dynamicArray = new DynamicArray();

for ($i = 0; $i < 10; $i++) {
    $dynamicArray->insert($i);
    echo "Inserted $i, array: ";
    print_r($dynamicArray->getArray());
    echo "\n";
}

?>