<?php


function bfs($graph, $start) {
    $visited = [];  // Масив за следене на посетените възли
    $queue = [];  // Опашка за следене на възлите за посещение

    // Добавяме началния възел в опашката и го маркираме като посетен
    array_push($queue, $start);
    $visited[$start] = true;

    while (!empty($queue)) {
        $node = array_shift($queue);  // Изваждаме първия възел от опашката
        echo $node . " ";  // Посещаваме текущия възел

        if(empty($graph[$node])) {
            $visited[$node] = true;
            continue;
        }
        // Обхождаме съседите на текущия възел
        foreach ($graph[$node] as $neighbor) {
            if (!isset($visited[$neighbor])) {  // Ако съседът не е посетен
                array_push($queue, $neighbor);  // Добавяме го в опашката
                $visited[$neighbor] = true;  // Маркираме го като посетен
            }
        }
    }

    return $queue;
}

// Граф представен като масив на съседство
$graph = [
    7 => [19, 21, 14],
    19 => [1, 12, 31],
    21 => [],
    14 => [23,6],
    1 => [],
    12 => [],
    31 => [],
    23 => [],
    6 => []
];

// Извикваме BFS от началния възел 0
bfs($graph, 7);