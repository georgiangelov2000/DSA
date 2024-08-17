<?php
function generateRandomArray($size) {
    $arr = [];
    for ($i = 0; $i < $size; $i++) {
        $arr[] = rand(0, $size);
    }
    return $arr;
}
function bubbleSort(&$arr, &$comparisons, &$swaps) {
    $size = sizeof($arr);
    $comparisons = 0;
    $swaps = 0;

    for ($i = 0; $i < $size; $i++) { 
        $swapped = false;
        
        for ($j = 0; $j < $size - $i - 1; $j++) {
            $comparisons++;
            if ($arr[$j] > $arr[$j + 1]) {
                $t = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $t;
                $swaps++;
                $swapped = true;                
            }
        }
        if ($swapped === false) {
            break;
        }
    }
}

$size = 10000;
$randomArray = generateRandomArray($size);
$comparisons = 0;
$swaps = 0;
$randomArray = [2,1,4,3];
$start_time = microtime(true);
bubbleSort($randomArray, $comparisons, $swaps);
$end_time = microtime(true);
$execution_time = $end_time - $start_time;
echo "Bubble Sort:\n";
echo "Comparisons: $comparisons\n";
echo "Swaps: $swaps\n";
echo "Execution time: $execution_time\n";
// echo "Sorted array: " . implode(" ", $arr) . "\n";