<?php


$arr = [
    7 => [19, 21, 14],
    19 => [1, 12, 31],
    21 => [],
    14 => [23,6],
    1 => [],
    12 => [],
    31 => [],
    23 => [],
    6 => [],
];

function postOrderDfs($graph, $node, &$visited) {
    // Обхождаме всички деца на текущия възел
    foreach ($graph[$node] as $child) {
        postOrderDfs($graph, $child, $visited);
    }
    // Посещаваме текущия възел
    $visited[] = $node;
}

// Начална точка
$visited = [];
$startNode = 7;
postOrderDfs($arr, $startNode, $visited);

echo implode(", ", $visited);  // Печатаме резултата