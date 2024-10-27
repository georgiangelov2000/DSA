<?php 
    $matrix = [[8,7],[9,9],[7,4],[9,7]];

    usort($matrix, function($a, $b) {
        return $a[0] <=> $b[0];
    });

    $right = 1;
    $res = 0;

    for ($i=0; $right < count($matrix); $i++) { 
        $res = max(abs($matrix[$i][0] - $matrix[$right][0]), $res) ;
        $right ++;   
    }

    echo $res;
?>