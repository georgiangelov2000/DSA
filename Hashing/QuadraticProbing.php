<?php

// Създаваме хеш таблица с размер 7
$hashTable = array_fill(0, 7, null);

// Хеш функция
function hashFunction($key, $size) {
    return $key % $size;
}

// Функция за квадратично проверяване
function insertQuadraticProbing(&$hashTable, $key, $value) {
    $size = count($hashTable);
    $index = hashFunction($key, $size);
    $i = 0;

    // Квадратично проверяване
    while ($hashTable[$index] !== null) {
        $i++;
        $index = ($index + $i * $i) % $size; // Преминава към следващия индекс със стъпка i^2
    }

    $hashTable[$index] = [$key => $value];
}

// Функция за търсене с квадратично проверяване
function searchQuadraticProbing($hashTable, $key) {
    $size = count($hashTable);
    $index = hashFunction($key, $size);
    $i = 0;

    while ($hashTable[$index] !== null) {
        if (array_key_exists($key, $hashTable[$index])) {
            return $hashTable[$index][$key];
        }
        $i++;
        $index = ($index + $i * $i) % $size;
    }

    return null; // Ако ключът не е намерен
}

// Вмъкване на стойности в хеш таблицата
insertQuadraticProbing($hashTable, 10, 'Alice');
insertQuadraticProbing($hashTable, 17, 'Bob');
insertQuadraticProbing($hashTable, 3, 'Charlie');
insertQuadraticProbing($hashTable, 10, 'David');

// Печат на хеш таблицата
print_r($hashTable);

// Търсене на стойности
echo "Търсене на ключ 10: " . searchQuadraticProbing($hashTable, 10) . "\n";
echo "Търсене на ключ 17: " . searchQuadraticProbing($hashTable, 17) . "\n";
echo "Търсене на ключ 3: " . searchQuadraticProbing($hashTable, 3) . "\n";