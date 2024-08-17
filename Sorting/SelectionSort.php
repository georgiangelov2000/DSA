<?php
function generateRandomArray($size) {
    $arr = [];
    for ($i = 0; $i < $size; $i++) {
        $arr[] = rand(0, $size);
    }
    return $arr;
}


function selection_sort(&$arr, $n, &$comparisons, &$swaps) 
{
    $comparisons = 0;
    $swaps = 0;

    for($i = 0; $i < $n ; $i++)
    {
        $low = $i;
        for($j = $i + 1; $j < $n ; $j++)
        {
            $comparisons++;
            if ($arr[$j] < $arr[$low])
            {
                $low = $j;
            }
        }
        
        if ($arr[$i] > $arr[$low])
        {
            $tmp = $arr[$i];
            $arr[$i] = $arr[$low];
            $arr[$low] = $tmp;
            $swaps++;
        }
    }
}

$size = 10000;
$randomArray = generateRandomArray($size);
$comparisons = 0;
$swaps = 0;
$randomArray = [9,5,4,3,6,7];
$len = count($randomArray);
$start_time = microtime(true);
selection_sort($randomArray, $len, $comparisons, $swaps);
$end_time = microtime(true);
$execution_time = $end_time - $start_time;
echo "Selection Sort:\n";
echo "Comparisons: $comparisons\n";
echo "Swaps: $swaps\n";
echo "Execution time: $execution_time\n";
// echo "Sorted array: " . implode(" ", $randomArray) . "\n";