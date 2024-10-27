<?php 
    $nums = [2,5,1,3,4,7];
    $n = 3;
    $newArr = [];
    
    for ($i=0; $i < $n ; $i++) { 
        $newArr[]=$nums[$i];
        $newArr[]=$nums[$i + $n];
    }

    return $newArr;
?>