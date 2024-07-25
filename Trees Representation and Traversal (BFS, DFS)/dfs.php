<?php

// Представяне на хората и техните познанства като граф
// $party = [
//     'A' => ['B', 'C'],
//     'B' => ['A', 'D', 'E'],
//     'C' => ['A', 'F'],
//     'D' => ['B'],
//     'E' => ['B'],
//     'F' => ['C']
// ];

// function dfs($graph, $start, $target) {
//     $stack = [$start];  // Започваме с хората, които вече познаваме
//     $visited = [];  // Масив за следене на посетените хора

//     while (!empty($stack)) {
//         $person = array_pop($stack);  // Изваждаме последния човек от стека
//         if (!in_array($person, $visited)) {
//             echo "Проверяваме: $person\n";  // Проверяваме текущия човек
//             if ($person === $target) {
//                 echo "Намерихме приятеля си: $person!\n";  // Намерихме приятеля си
//                 return;
//             }
//             $visited[] = $person;  // Маркираме човека като посетен

//             // Добавяме познатите на текущия човек в стека
//             foreach ($graph[$person] as $neighbor) {
//                 if (!in_array($neighbor, $visited)) {
//                     $stack[] = $neighbor;
//                 }
//             }
//         }
//     }
// }

// // Извикваме DFS от началния човек A, за да намерим приятеля E
// dfs($party, 'A', 'E');

$party = [
    'A' => ['B', 'C'],
    'B' => ['A', 'D', 'E'],
    'C' => ['A', 'F'],
    'D' => ['B'],
    'E' => ['B'],
    'F' => ['C']
];

function dfs_recursive($graph, $node, &$visited) {
    if (!in_array($node, $visited)) {
        echo "Посещаваме: $node\n";  // Посещаваме текущия възел
        $visited[] = $node;  // Маркираме възела като посетен

        // Рекурсивно обхождаме съседите на текущия възел
        foreach ($graph[$node] as $neighbor) {
            dfs_recursive($graph, $neighbor, $visited);
        }
    }
}

// Начална точка
$visited = [];
$startNode = 'A';
dfs_recursive($party, $startNode, $visited);