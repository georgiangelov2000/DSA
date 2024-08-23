<?php

// Създаваме хеш таблица с размер 5
$hashTable = array_fill(0, 5, []);

// Хеш функция, която използва ASCII стойността на първата буква и дели на размера на хеш таблицата
function hashFunction($key, $size) {
    $asciiValue = ord($key[0]); // ord() връща ASCII стойността на първия символ
    return $asciiValue % $size; // Връща хеш стойността
}

// Функция за добавяне на данни в хеш таблицата
function insert(&$hashTable, $key, $value) {
    $index = hashFunction($key, count($hashTable));
    $hashTable[$index][] = [$key => $value]; // Използваме свързване (chaining) за справяне с колизии
}

// Функция за търсене на данни в хеш таблицата
function search($hashTable, $key) {
    $index = hashFunction($key, count($hashTable));
    foreach ($hashTable[$index] as $pair) {
        if (isset($pair[$key])) {
            return $pair[$key]; // Връщаме стойността, ако ключът съвпада
        }
    }
    return null; // Връща null, ако ключът не е намерен
}

// Вмъкваме данни в хеш таблицата
insert($hashTable, 'Alice', '123-4567');
insert($hashTable, 'Bob', '234-5678');
insert($hashTable, 'Charlie', '345-6789');
insert($hashTable, 'David', '456-7890');
insert($hashTable, 'Carl', '456-1234');

// Търсене на данни
echo "Телефонният номер на Charlie е: " . search($hashTable, 'Charlie') . "\n";
echo "Телефонният номер на Carl е: " . search($hashTable, 'Carl') . "\n";
echo "Телефонният номер на Bob е: " . search($hashTable, 'Bob') . "\n";

// Показване на съдържанието на хеш таблицата
print_r($hashTable);