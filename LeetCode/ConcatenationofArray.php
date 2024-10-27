<?php 
    $nums = [1,2,3];
    $n = count($nums);
    $ans = array_fill(0,2*$n,0);

    for ($i=0; $i < $n; $i++) { 
        $ans[$i] = $nums[$i];
        $ans[$i + $n] = $nums[$i];
    }

    return $ans;
    
?>