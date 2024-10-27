<?php 
    $nums =  [1,2,3,1,1,3];
    $left = 0;
    $goodPairs = 0;
    $length = count($nums);

    while ($left < $length) {
        for ($i = $left + 1; $i < $length; $i++) { 
            if($nums[$left] === $nums[$i]) {
                $goodPairs++;
            }
        }
        $left ++;   
    }
    return $goodPairs;
?>