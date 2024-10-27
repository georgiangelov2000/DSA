<?php 
// First example
    $res = [];
    $nums = [10,4,8,3];
    $nums = [1];
    $leftSide = [0];
    $rightSide = [];

    for ($i = 1; $i < count($nums); $i++) {
        $nums[$i] += $nums[$i - 1];
    }

    for ($j=0; $j < count($nums); $j++) {
        if($j !== count($nums) - 1) {
            $leftSide[]=$nums[$j];
        }
        $rightSide[]=$nums[count($nums) - 1] - $nums[$j];
    }

    for ($k=0; $k < count($leftSide); $k++) { 
        $res[]= abs($leftSide[$k] - $rightSide[$k]);
    }

    return $res;

// Second Example 
    // $res = [];
    // $leftSide = [0];
    // $rightSide = [0];

    // for ($i = 1; $i < count($nums); $i++) {
    //     $nums[$i] += $nums[$i - 1];
    // }

    // for ($j=0; $j < count($nums) - 1; $j++) {
    //     $leftSide[]=$nums[$j];
    //     $rightSide[]=$nums[count($nums) - 1] - $nums[$j];
    // }

    // rsort($rightSide);
    // for ($k=0; $k < count($leftSide); $k++) { 
    //     $res[]= abs($leftSide[$k] - $rightSide[$k]);
    // }
    // return $res;
?>