<?php
function generateRandomArray($size) {
    $arr = [];
    for ($i = 0; $i < $size; $i++) {
        $arr[] = rand(0, $size);
    }
    return $arr;
}

function shellSort($arr, &$comparisons, &$swaps)
{
    $n = sizeof($arr);
    $comparisons = 0;
    $swaps = 0;
 
    for ($gap = floor($n / 2); $gap > 0; $gap = floor($gap / 2))
    {    
        for ($i = $gap; $i < $n; $i += 1)
        {
            $temp = $arr[$i];
            $j = $i;
            $comparisons++;

            while ($j >= $gap && $arr[$j - $gap] > $temp) {
                $arr[$j] = $arr[$j - $gap];
                $j -= $gap;
                $comparisons++;
                $swaps++;
            }

            $arr[$j] = $temp;
        }
    }
    return $arr;
}

// Примерен масив
$arr = [12, 34, 54, 2, 3];
$comparisons = 0;
$swaps = 0;
// $randomArray = generateRandomArray(10000);
$start_time = microtime(true);
$sortedArr = shellSort($arr, $comparisons, $swaps);
$end_time = microtime(true);
$execution_time = $end_time - $start_time;
// Показване на сортирания масив
echo "Sorted array:\n";
echo implode(" ", $sortedArr) . "\n";
echo "Comparisons: $comparisons\n";
echo "Swaps: $swaps\n";
echo "Execution time: $execution_time\n";