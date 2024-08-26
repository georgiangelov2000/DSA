<?php
// Iterative Binary Search log(n)
//Auxiliary Space: O(log(n)) due to recursive calls, otherwise iterative version uses Auxiliary Space of O(1).
function binarySearch($arr, $low, 
                      $high, $x)
{
    while ($low <= $high)
    {
        $mid = floor($low + ($high - $low) / 2);

        // Check if x is present at mid
        if ($arr[$mid] == $x)
            return floor($mid);

        // If x greater, ignore
        // left half
        if ($arr[$mid] < $x)
            $low = $mid + 1;

        // If x is smaller, 
        // ignore right half
        else
            $high = $mid - 1;
    }

    // If we reach here, then 
    // element was not present
    return -1;
}

//Time Complexity: O(N) [In the worst case all elements may have to be moved] 
//Auxiliary Space: O(1)
function insertedSorted($arr,$n,$key) {
    for ($i = $n-1; $i >= 0 && $arr[$i] > $key; $i--)
    {
        $arr[$i+1] = $arr[$i];
    }
    
    $arr[$i+1] = $key;
    return ($n+1);
}

//Time Complexity: O(log(n)) Using Binary Search
function binarySearchRecursively($arr,$low,$high,$key){
    if($high < $low ) {
        return -1;
    }
    $mid = floor(($low + $high) / 2);
    if($arr[$mid] == $key) {
        return $mid;
    }
    if($arr[$mid] < $key) {
        return binarySearchRecursively($arr,$mid+1,$high,$key);
    }
    else {
        return binarySearchRecursively($arr,$low,$mid-1,$key);
    }
}

//Time Complexity: O(N). In the worst case all elements may have to be moved
//Auxiliary Space: O(log N). An implicit stack will be use
function deleteElement($arr,$n,$key) {
    $pos = binarySearchRecursively($arr, 0, $n - 1, $key);

    if(!$pos) {
        echo "Element not found";
        return $n;
    }
    $i = null;
    for ($i = $pos; $i < $n - 1; $i++) { 
        $arr[$i] = $arr[$i + 1];
    }

    $n = $n - 1;
    unset($arr[$n]);

    return $n;
}

function binary_search_insert_position($arr, $element) {
    $low = 0;
    $high = count($arr) - 1;

    while ($low <= $high) {
        $mid = intval(($low + $high) / 2);

        if ($arr[$mid] == $element) {
            return $mid; // Елементът вече съществува, връщаме текущата позиция
        } elseif ($arr[$mid] < $element) {
            $low = $mid + 1;
        } else {
            $high = $mid - 1;
        }
    }

    return $low; // Връщаме позицията за вмъкване
}
function insert_element(&$arr, $element) {
    $position = binary_search_insert_position($arr, $element);
    array_splice($arr, $position, 0, $element);
}

$sortedArray = [10, 20, 30, 40, 60, 70];
$elementToInsert = 50;

insert_element($sortedArray, $elementToInsert);

print_r($sortedArray);

// Deletion Binary Search tree Recursively
// $arr = array(12,16,20,40,50,70);
// $n = count($arr);
// $x = 16;
// deleteElement($arr,$n,$x);

// Insertion Binary Search tree
// $arr = array(12,16,20,40,50,70);
// $n = count($arr);
// $x = 25;
// insertedSorted($arr,$n,$x);

// Binary search iterative
// $arr = array(2, 3, 4, 10, 40);
// $n = count($arr);
// $x = 10;
// $result = binarySearch($arr, 0, 
//                        $n - 1, $x);
// if(($result == -1))
// echo "Element is not present in array";
// else
// echo "Element is present at index ";