<?php

#$nx: The coordinate of the next row (next horizontal position).
#$ny: The column coordinate (next vertical position).
#$dx: The change in horizontal coordinate that is applied to the current direction.
#$dy: The change in vertical coordinate that is applied to the current direction.

function shortestPathLength($map) {
    $height = count($map);
    $width = count($map[0]);
    $directions = [[0, 1], [0, -1], [1, 0], [-1, 0]]; // Дясно, Ляво, Долу, Горе

    // We check if a given position is within the bounds of the maze
    $isValidPosition = function($x, $y) use ($height, $width) {
        return $x >= 0 && $x < $height && $y >= 0 && $y < $width;
    };

    // Breadth-First Search function
    $bfs = function() use ($map, $height, $width, $directions, $isValidPosition) {
        $queue = new SplQueue();
        $queue->enqueue([0, 0, 0, false]); // (x, y, steps, has_removed_wall)
        $visited = []; // Array of visited cells, with or without wall removed

        while (!$queue->isEmpty()) {
            [$x, $y, $steps, $has_removed_wall] = $queue->dequeue();

            // Ако сме достигнали изхода, връщаме броя на стъпките
            if ($x == $height - 1 && $y == $width - 1) {
                return $steps + 1;
            }

            // If we've reached the exit, return the number of steps
            foreach ($directions as [$dx, $dy]) {
                $nx = $x + $dx;
                $ny = $y + $dy;

                // We check if the next position is valid and hasn't been visited
                if ($isValidPosition($nx, $ny) && !isset($visited[$nx][$ny][$has_removed_wall])) {
                    // If the next cell is a wall and no wall has been removed yet
                    if ($map[$nx][$ny] == 1 && !$has_removed_wall) {
                        // We mark the next cell as visited with the wall removed
                        $visited[$nx][$ny][true] = true;
                        // print_r($visited);
                        $queue->enqueue([$nx, $ny, $steps + 1, true]);
                    }
                   // If the next cell is passable
                    elseif ($map[$nx][$ny] == 0) {
                       // We mark the next cell as visited
                        $visited[$nx][$ny][$has_removed_wall] = true;
                        // print_r($visited);
                        $queue->enqueue([$nx, $ny, $steps + 1, $has_removed_wall]);
                    }
                }
            }
        }

        // Ако изходът не е достижим
        return -1;
    };

    // Извикваме обхождането в ширина, за да намерим най-краткия път
    return $bfs();
}

// Тестови случаи
$map1 = [
    [0, 0, 0, 0, 0, 0],
    [1, 1, 1, 1, 1, 0],
    [0, 0, 0, 0, 0, 0],
    [0, 1, 1, 1, 1, 1],
    [0, 1, 1, 1, 1, 1],
    [0, 0, 0, 0, 0, 0]
];
echo shortestPathLength($map1);  // Извежда: 11
echo "\n";

$map2 = [
    [0, 1, 1, 0],
    [0, 0, 0, 1],
    [1, 1, 0, 0],
    [1, 1, 1, 0]
];
echo shortestPathLength($map2);  // Извежда: 7
echo "\n";