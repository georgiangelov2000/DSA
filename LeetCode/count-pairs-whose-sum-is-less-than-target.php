<?php 
    $arr = [-6,2,5,-2,-7,-1,3];
    $left = 0;
    $right = 1;
    $length = count($arr);
    $goodPairs = 0;
    $target = -2;
    
    while ($left < $length) {
        for ($i=$right; $i < $length; $i++) { 
            if($arr[$left] + $arr[$i] < $target) {
                $goodPairs ++;
            }
        }
        $left ++;
        $right ++;
    }
    return $goodPairs;
?>