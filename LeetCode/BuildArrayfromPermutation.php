<?php 
    $nums = [1,2,3];
    $n = count($nums);
    $ans = [];

    for ($i=0; $i < $n; $i++) { 
        $ans[] = $nums[$nums[$i]];
    }


    // $n = count($nums);
    // $ans = array_fill(0,$n,0);

    // // O(n);
    // for ($i = 0; $i < $n; $i++) {
    //     $ans[$i] = $nums[$nums[$i]];
    // }

    // return $ans;
?>