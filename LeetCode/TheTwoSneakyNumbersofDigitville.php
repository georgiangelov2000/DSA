<?php 
    $nums = [7,1,5,4,3,4,6,0,9,5,8,2];
    $hashTable = [];
    $countMapper = [];

    for($i = 0; $i < count($nums); $i++) {
        if( isset($hashTable[$nums[$i]]) ) {
            $hashTable[$nums[$i]] += 1;
        } else {
            $hashTable[$nums[$i]] = 1;
        }
    }

    foreach($hashTable as $key => $count ) {
        if($count > 1) {
            $countMapper[]=$key;
        }
    }

    var_dump($countMapper);
?>