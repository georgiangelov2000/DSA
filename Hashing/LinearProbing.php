<?php
// Създаваме хеш таблица с размер 7
$hashTable = array_fill(0, 7, null);

// Хеш функция
function hashFunction($key, $size) {
    return $key % $size;
}

// Функция за линейно проверяване
function insertLinearProbing(&$hashTable, $key, $value) {
    $size = count($hashTable);
    $index = hashFunction($key, $size);

    // Линейно проверяване
    while ($hashTable[$index] !== null) {
        $index = ($index + 1) % $size; // Преминава към следващия индекс
    }

    $hashTable[$index] = [$key => $value];
}

// Функция за търсене с линейно проверяване
function searchLinearProbing($hashTable, $key) {
    $size = count($hashTable);
    $index = hashFunction($key, $size);

    while ($hashTable[$index] !== null) {
        if (array_key_exists($key, $hashTable[$index])) {
            return $hashTable[$index][$key];
        }
        $index = ($index + 1) % $size;
    }

    return null; // Ако ключът не е намерен
}

// Вмъкване на стойности в хеш таблицата
insertLinearProbing($hashTable, 10, 'Alice');
insertLinearProbing($hashTable, 17, 'Bob');
insertLinearProbing($hashTable, 3, 'Charlie');
insertLinearProbing($hashTable, 10, 'David');

// Печат на хеш таблицата
print_r($hashTable);

// Търсене на стойности
echo "Търсене на ключ 10: " . searchLinearProbing($hashTable, 10) . "\n";
echo "Търсене на ключ 17: " . searchLinearProbing($hashTable, 17) . "\n";
echo "Търсене на ключ 3: " . searchLinearProbing($hashTable, 3) . "\n";