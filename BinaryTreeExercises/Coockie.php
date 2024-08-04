<?php

class MinHeap {
    private $heap = [];
    private $index;
    private $operations;
    private $leftSlider;
    private $rightSlider;

    public function __construct($array) {
        $this->heap = $array;
        $this->index = 0;
        $this->leftSlider = 0;
        $this->rightSlider = 2;
        $this->operations = 0;
    }

    public function cookies($k) {
        $sum = 0;

        if($this->leftSlider >= count($this->heap) - 1 || count($this->heap) === 0) {
            return $this->operations;
        }

        list($el1, $el2) = array_splice($this->heap, $this->leftSlider, $this->rightSlider);
        
        $this->leftSlider+=1;

        $sum = $el1 + (2* $el2);
        array_unshift($this->heap,$sum);

        echo "Премахнати елементи: $el1, $el2\n";
        echo "Сума: $sum\n";
        if($sum > $k) {
            $this->operations++;
        }

        return $this->cookies($k);
    }
}

// Пример за използване
$array = [1, 2, 3, 9, 10, 12];
$minHeap = new MinHeap($array);
echo "Брой рекурсивни опеарции" . " " . $minHeap->cookies(7);