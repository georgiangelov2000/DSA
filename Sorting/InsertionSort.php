<?php
function generateRandomArray($size) {
    $arr = [];
    for ($i = 0; $i < $size; $i++) {
        $arr[] = rand(0, $size);
    }
    return $arr;
}
// function insertionSort(&$arr, $n, &$comparisons, &$swaps)
// {
//     for ($i = 1; $i < $n; $i++)
//     {
//         $key = $arr[$i];
//         $j = $i - 1;

//         $comparisons++;
//         while ($j >= 0 && $arr[$j] > $key)
//         {
//             $arr[$j + 1] = $arr[$j];
//             $swaps++;
//             $j = $j - 1;
//         }
        
//         $arr[$j + 1] = $key;
//     }
// }

function insertionSort(&$arr, $n, &$comparisons, &$swaps)
{
    for ($i = 1; $i < $n; $i++)
    {
        $key = $arr[$i];
        $j = $i - 1;

        while ($j >= 0) {
            $comparisons++;
            if ($arr[$j] > $key) {
                $arr[$j + 1] = $arr[$j];
                $swaps++;
                $j--;
            } else {
                break;
            }
        }
        
        $arr[$j + 1] = $key;
        if ($j + 1 != $i) {
            $swaps++;
        }
    }
}

$size = 10000;
$start_time = microtime(true);
$randomArray = generateRandomArray($size);
$end_time = microtime(true);
$execution_time = $end_time - $start_time;
$comparisons = 0;
$swaps = 0;
$n = sizeof($randomArray);
insertionSort($randomArray, $n, $comparisons, $swaps);
echo "Insertion Sort:\n";
echo "Comparisons: $comparisons\n";
echo "Swaps: $swaps\n";
echo "Execution time: $execution_time\n";