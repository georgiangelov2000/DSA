<?php

class Set {
    private $elements;

    public function __construct() {
        $this->elements = [];
    }

    // Добавяне на елемент към множеството
    public function add($element) {
        $this->elements[$element] = true;
    }

    // Проверка дали множеството съдържа даден елемент
    public function contains($element) {
        return isset($this->elements[$element]);
    }

    // Обединение на това множество с друго
    public function union(Set $set) {
        $result = new Set();

        foreach ($this->elements as $element => $value) {
            $result->add($element);
        }

        foreach ($set->elements as $element => $value) {
            $result->add($element);
        }

        return $result;
    }

    // Пресичане на това множество с друго
    public function intersection(Set $set) {
        $result = new Set();

        foreach ($this->elements as $element => $value) {
            if ($set->contains($element)) {
                $result->add($element);
            }
        }

        return $result;
    }

    // Разлика между това множество и друго
    public function difference(Set $set) {
        $result = new Set();

        foreach ($this->elements as $element => $value) {
            if (!$set->contains($element)) {
                $result->add($element);
            }
        }

        return $result;
    }

    // Връщане на елементите като масив (за целите на отпечатването)
    public function getElements() {
        return array_keys($this->elements);
    }
}

// Създаване на две множества
$set1 = new Set();
$set2 = new Set();

// Добавяне на елементи към множествата
$set1->add(1);
$set1->add(2);
$set1->add(3);

$set2->add(3);
$set2->add(4);
$set2->add(5);

// Обединение на множествата
$unionSet = $set1->union($set2);
echo "Обединение: ";
print_r($unionSet->getElements()); // Показва [1, 2, 3, 4, 5]

// Пресичане на множествата
$intersectionSet = $set1->intersection($set2);
echo "Пресичане: ";
print_r($intersectionSet->getElements()); // Показва [3]

// Разлика на множествата
$differenceSet = $set1->difference($set2);
echo "Разлика: ";
print_r($differenceSet->getElements()); // Показва [1, 2]

// Проверка за принадлежност
echo "Съдържа ли се 4 в множеството? " . ($set1->contains(4) ? "Да" : "Не") . "\n"; // Показва "Не"