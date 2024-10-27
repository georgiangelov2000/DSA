<?php 
    $students = [3,2,1];
    $seats = [5,7,6];

    sort($students);
    sort($seats);
    $count = 0;

    for ($i=0; $i < count($seats); $i++) { 
        $count += abs($students[$i] - $seats[$i]);
    }

    echo $count;
?>