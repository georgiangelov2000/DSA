<?php
class DynamicArray {
    private $array;
    private $size;
    private $capacity;
    private $indexMap;

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

    private function resize() {
        $this->capacity *= 2;
        $newArray = array_fill(0, $this->capacity, null);
        for ($i = 0; $i < $this->size; $i++) {
            $newArray[$i] = $this->array[$i];
        }
        $this->array = $newArray;
    }

    public function indexOf($element) {
        for ($i = 0; $i < $this->size; $i++) {
            if ($this->array[$i] === $element) {
                return $i;
            }
        }
        return -1;
    }

    public function remove($element) {
        $index = $this->indexOf($element);
        if ($index === -1) {
            return false;
        }
        for ($i = $index; $i < $this->size - 1; $i++) {
            $this->array[$i] = $this->array[$i + 1];
        }
        $this->size--;
        return true;
    }

    public function getArray() {
        return array_slice($this->array, 0, $this->size);
    }
}

$dynamicArray = new DynamicArray();

for ($i = 0; $i < 10; $i++) {
    $dynamicArray->insert($i);
    echo "Inserted $i, array: ";
    print_r($dynamicArray->getArray());
    echo "\n";
}

// Пример за използване на indexOf и remove
// echo "Index of element 5: " . $dynamicArray->indexOf(5) . "\n";
echo "Remove element 5: " . ($dynamicArray->remove(5) ? "Success" : "Failed") . "\n";
echo "Array after removing element 5: ";
print_r($dynamicArray->getArray());

echo "Index of element 5: " . $dynamicArray->indexOf(5) . "\n";  // Should now return -1
echo "Remove element 5 again: " . ($dynamicArray->remove(5) ? "Success" : "Failed") . "\n";
echo "Array after trying to remove element 5 again: ";
print_r($dynamicArray->getArray());